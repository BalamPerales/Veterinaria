<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;

class ExpedienteController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');
        $mascotas = null;

        if ($query) {
            $mascotas = Mascota::with('dueno')
                ->where('nombre', 'like', "%{$query}%")
                ->orWhereHas('dueno', function ($q) use ($query) {
                    $q->where('nombre_completo', 'like', "%{$query}%")
                      ->orWhere('telefono', 'like', "%{$query}%");
                })
                ->paginate(10)
                ->appends(['q' => $query]);
        }

        return view('modules.admin.expedientes.index', compact('mascotas', 'query'));
    }

    /**
     * Búsqueda en tiempo real para JS usando Laravel Scout
     */
    public function searchApi(Request $request)
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return response()->json([]);
        }

        // Scout search
        $resultados = Mascota::search($query)
            ->query(function ($builder) {
                $builder->with('dueno');
            })
            ->take(5)
            ->get()
            ->map(function ($mascota) {
                return [
                    'id' => $mascota->id,
                    'nombre' => $mascota->nombre,
                    'dueno' => $mascota->dueno->nombre_completo ?? 'Desconocido',
                ];
            });

        return response()->json($resultados);
    }
}
