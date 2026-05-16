<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->get();
        return view('modules.admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('modules.admin.usuarios.create');
    }

    /**
     * Almacena el usuario recién creado en la base de datos.
     */
    public function store(StoreUsuarioRequest $request)
    {
        $validated = $request->validated();

        // Usar transacción para asegurar que ambos registros (User y Veterinario) se creen o ninguno
        try {
            DB::beginTransaction();

            // 1. Crear el usuario
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'rol' => $validated['rol'],
                'activo' => $request->has('activo'), // El checkbox enviará valor si está marcado
            ]);

            // 2. Crear el perfil de veterinario si corresponde
            if ($validated['rol'] === 'veterinario') {
                $fotoPath = null;
                
                // Manejar la subida de la imagen de firma
                if ($request->hasFile('foto_firma')) {
                    // Guarda en storage/app/public/firmas
                    $fotoPath = $request->file('foto_firma')->store('firmas', 'public');
                }

                Veterinario::create([
                    'usuario_id' => $user->id,
                    'nombre_completo' => $user->name, // Replicar el nombre por diseño del schema
                    'especialidad' => $request->especialidad,
                    'cedula_profesional' => $request->cedula_profesional,
                    'foto_firma' => $fotoPath,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.usuarios.create')
                             ->with('success', 'Usuario creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Hubo un problema al crear el usuario: ' . $e->getMessage()]);
        }
    }

    /**
     * Muestra el formulario para editar un usuario.
     */
    public function edit(User $usuario)
    {
        // Eager load el veterinario si tiene
        $usuario->load('veterinario');
        
        return view('modules.admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Actualiza el usuario en la base de datos.
     */
    public function update(UpdateUsuarioRequest $request, User $usuario)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            // 1. Actualizar datos base del usuario
            $usuario->name = $validated['name'];
            $usuario->email = $validated['email'];
            $usuario->activo = $request->has('activo');

            // Solo actualizar contraseña si se ingresó una nueva
            if (!empty($validated['password'])) {
                $usuario->password = Hash::make($validated['password']);
            }

            // Validar cambio de rol: No permitir cambiar de Veterinario a Administrador
            // (La Opción A del plan: bloquear en UI y proteger en Backend)
            if ($usuario->rol === 'veterinario' && $validated['rol'] !== 'veterinario') {
                DB::rollBack();
                return back()->withInput()->withErrors(['rol' => 'No se puede cambiar el rol de un veterinario existente. Puede marcarlo como Inactivo en su lugar.']);
            }

            $usuario->rol = $validated['rol'];
            $usuario->save();

            // 2. Gestionar perfil de Veterinario
            if ($validated['rol'] === 'veterinario') {
                $veterinario = $usuario->veterinario;
                
                // Si no existía (era admin y ahora es vet), crear el registro
                if (!$veterinario) {
                    $veterinario = new Veterinario();
                    $veterinario->usuario_id = $usuario->id;
                }

                $veterinario->nombre_completo = $usuario->name;
                $veterinario->especialidad = $request->especialidad;
                $veterinario->cedula_profesional = $request->cedula_profesional;

                // Manejar subida de nueva imagen
                if ($request->hasFile('foto_firma')) {
                    // Borrar firma anterior si existe
                    if ($veterinario->foto_firma && \Illuminate\Support\Facades\Storage::disk('public')->exists($veterinario->foto_firma)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($veterinario->foto_firma);
                    }
                    
                    $fotoPath = $request->file('foto_firma')->store('firmas', 'public');
                    $veterinario->foto_firma = $fotoPath;
                }

                $veterinario->save();
            }

            DB::commit();

            return redirect()->route('admin.usuarios.index')
                             ->with('success', 'Usuario actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Hubo un problema al actualizar el usuario: ' . $e->getMessage()]);
        }
    }

    /**
     * Muestra la vista de confirmación para eliminar un usuario.
     */
    public function show(User $usuario)
    {
        $usuario->load('veterinario');
        $puedeEliminar = true;
        $mensajeDependencia = '';

        // 1. Validar si es el mismo usuario en sesión
        if (Auth::id() === $usuario->id) {
            $puedeEliminar = false;
            $mensajeDependencia = 'No puedes eliminar tu propia cuenta mientras estás conectado.';
        } 
        // 2. Validar dependencias si es veterinario
        elseif ($usuario->rol === 'veterinario' && $usuario->veterinario) {
            if ($usuario->veterinario->consultas()->exists()) {
                $puedeEliminar = false;
                $mensajeDependencia = 'Este usuario no puede ser eliminado porque tiene consultas registradas en el sistema. Puedes marcarlo como inactivo en la vista de edición.';
            }
        }

        return view('modules.admin.usuarios.show', compact('usuario', 'puedeEliminar', 'mensajeDependencia'));
    }

    /**
     * Elimina el usuario de la base de datos.
     */
    public function destroy(User $usuario)
    {
        // 1. Validar si es el mismo usuario en sesión
        if (Auth::id() === $usuario->id) {
            return back()->withErrors(['error' => 'No puedes eliminar tu propia cuenta.']);
        }

        // 2. Validar dependencias si es veterinario
        if ($usuario->rol === 'veterinario' && $usuario->veterinario) {
            if ($usuario->veterinario->consultas()->exists()) {
                return back()->withErrors(['error' => 'No se puede eliminar: El veterinario tiene consultas asociadas.']);
            }
            
            // Borrar la foto de firma si existe antes de borrar el registro
            if ($usuario->veterinario->foto_firma && \Illuminate\Support\Facades\Storage::disk('public')->exists($usuario->veterinario->foto_firma)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($usuario->veterinario->foto_firma);
            }
        }

        try {
            // El borrado en cascada (onDelete('cascade')) se encargará de borrar el registro en 'veterinarios'
            $usuario->delete();

            return redirect()->route('admin.usuarios.index')
                             ->with('success', 'El usuario ha sido eliminado permanentemente del sistema.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocurrió un error al intentar eliminar el usuario: ' . $e->getMessage()]);
        }
    }
}
