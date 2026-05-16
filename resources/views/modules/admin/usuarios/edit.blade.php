@extends('layouts.admin')

@section('titulo_pagina', 'Editar Usuario — Veterinaria')

@section('page_title', 'Editar Usuario: ' . $usuario->name)

@section('page_actions')
    <a href="{{ route('admin.usuarios.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Volver a la Lista
    </a>
@endsection

@section('contenido')

    {{-- Mostrar mensajes de error globales --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-left-danger" role="alert">
            <ul class="mb-0 pl-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-user-edit mr-2"></i>Actualizar Información</h6>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Sección: Datos Básicos --}}
                        <h5 class="text-primary font-weight-bold mb-3 border-bottom pb-2">Datos Básicos</h5>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold text-gray-800">Nombre Completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold text-gray-800">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="font-weight-bold text-gray-800">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco para no cambiar">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="font-weight-bold text-gray-800">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite la nueva contraseña">
                            </div>
                        </div>

                        <div class="form-row align-items-center mb-4">
                            <div class="form-group col-md-6 mb-0">
                                <label for="rol" class="font-weight-bold text-gray-800">Rol del Usuario <span class="text-danger">*</span></label>
                                
                                @if($usuario->rol === 'veterinario')
                                    {{-- Bloquear cambio si ya es veterinario --}}
                                    <input type="hidden" name="rol" value="veterinario">
                                    <select class="form-control custom-select" id="rol_disabled" disabled>
                                        <option value="veterinario" selected>Veterinario</option>
                                    </select>
                                    <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> No se puede cambiar el rol a un veterinario registrado. Puedes marcarlo como inactivo.</small>
                                @else
                                    <select class="form-control custom-select" id="rol" name="rol" required>
                                        <option value="administrador" {{ old('rol', $usuario->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                        <option value="veterinario" {{ old('rol', $usuario->rol) == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                                    </select>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-0 mt-4 text-center">
                                <div class="custom-control custom-switch custom-switch-lg">
                                    <input type="checkbox" class="custom-control-input" id="activo" name="activo" value="1" {{ old('activo', $usuario->activo) ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold text-gray-800" for="activo" style="padding-top: 3px;">Usuario Activo</label>
                                </div>
                            </div>
                        </div>

                        {{-- Sección: Datos de Veterinario (Oculto por defecto si no es veterinario) --}}
                        <div id="seccion_veterinario" style="{{ old('rol', $usuario->rol) === 'veterinario' ? '' : 'display: none;' }}" class="bg-light p-3 rounded border border-left-warning mb-4 mt-2">
                            <h5 class="text-warning font-weight-bold mb-3 border-bottom pb-2"><i class="fas fa-user-md mr-2"></i>Datos Profesionales (Veterinario)</h5>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="especialidad" class="font-weight-bold text-gray-800">Especialidad</label>
                                    <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{ old('especialidad', $usuario->veterinario->especialidad ?? '') }}" placeholder="Ej. Cirugía de pequeñas especies">
                                    <small class="form-text text-muted">Opcional.</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cedula_profesional" class="font-weight-bold text-gray-800">Cédula Profesional</label>
                                    <input type="text" class="form-control" id="cedula_profesional" name="cedula_profesional" value="{{ old('cedula_profesional', $usuario->veterinario->cedula_profesional ?? '') }}" placeholder="Número de cédula">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto_firma" class="font-weight-bold text-gray-800">Actualizar Foto de Firma</label>
                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="foto_firma" name="foto_firma" accept="image/*">
                                    <label class="custom-file-label" for="foto_firma" data-browse="Elegir archivo">Seleccionar nueva imagen...</label>
                                </div>
                                
                                @if($usuario->veterinario && $usuario->veterinario->foto_firma)
                                    <div class="mt-2">
                                        <p class="mb-1 text-sm text-gray-600">Firma Actual:</p>
                                        <img src="{{ Storage::url($usuario->veterinario->foto_firma) }}" alt="Firma actual" class="img-thumbnail" style="max-height: 80px;">
                                    </div>
                                @endif
                                <small class="form-text text-muted">Formatos: JPG, PNG, GIF. Máximo 2MB. Si dejas esto vacío, se mantendrá la firma actual.</small>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i> Actualizar Usuario
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    /* Estilos para hacer el switch más grande y visible */
    .custom-switch-lg .custom-control-label::before {
        height: 1.5rem;
        width: 2.75rem;
        border-radius: 3rem;
    }
    .custom-switch-lg .custom-control-label::after {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 3rem;
    }
    .custom-switch-lg .custom-control-input:checked ~ .custom-control-label::after {
        transform: translateX(1.25rem);
    }
    .custom-switch-lg .custom-control-label {
        padding-left: 1.5rem;
        padding-top: 0.2rem;
    }
</style>
@endpush

@push('scripts')
    {{-- Reutilizamos el mismo JS de crear porque la lógica de mostrar/ocultar campos de veterinario es igual --}}
    <script src="{{ asset('js/admin/usuarios/create.js') }}"></script>
@endpush
