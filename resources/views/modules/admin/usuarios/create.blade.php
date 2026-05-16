@extends('layouts.admin')

@section('titulo_pagina', 'Nuevo Usuario — Veterinaria')

@section('page_title', 'Crear Usuario')

@section('page_actions')
    <a href="{{ route('admin.home') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Volver al Panel
    </a>
@endsection

@section('contenido')

    {{-- Mostrar mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

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
            <div class="card shadow mb-4 border-bottom-danger">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-gradient-danger">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-user-plus mr-2"></i>Información del Nuevo Usuario</h6>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Sección: Datos Básicos --}}
                        <h5 class="text-danger font-weight-bold mb-3 border-bottom pb-2">Datos Básicos</h5>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold text-gray-800">Nombre Completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. Juan Pérez" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold text-gray-800">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="font-weight-bold text-gray-800">Contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="font-weight-bold text-gray-800">Confirmar Contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" required>
                            </div>
                        </div>

                        <div class="form-row align-items-center mb-4">
                            <div class="form-group col-md-6 mb-0">
                                <label for="rol" class="font-weight-bold text-gray-800">Rol del Usuario <span class="text-danger">*</span></label>
                                <select class="form-control custom-select" id="rol" name="rol" required>
                                    <option value="" disabled selected>Seleccione un rol...</option>
                                    <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                    <option value="veterinario" {{ old('rol') == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-0 mt-4 text-center">
                                <div class="custom-control custom-switch custom-switch-lg">
                                    <input type="checkbox" class="custom-control-input" id="activo" name="activo" value="1" {{ old('activo', '1') ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold text-gray-800" for="activo" style="padding-top: 3px;">Usuario Activo</label>
                                </div>
                            </div>
                        </div>

                        {{-- Sección: Datos de Veterinario (Oculto por defecto) --}}
                        <div id="seccion_veterinario" style="display: none;" class="bg-light p-3 rounded border border-left-warning mb-4 mt-2">
                            <h5 class="text-warning font-weight-bold mb-3 border-bottom pb-2"><i class="fas fa-user-md mr-2"></i>Datos Profesionales (Veterinario)</h5>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="especialidad" class="font-weight-bold text-gray-800">Especialidad</label>
                                    <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{ old('especialidad') }}" placeholder="Ej. Cirugía de pequeñas especies">
                                    <small class="form-text text-muted">Opcional.</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cedula_profesional" class="font-weight-bold text-gray-800">Cédula Profesional</label>
                                    <input type="text" class="form-control" id="cedula_profesional" name="cedula_profesional" value="{{ old('cedula_profesional') }}" placeholder="Número de cédula">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto_firma" class="font-weight-bold text-gray-800">Foto de Firma</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_firma" name="foto_firma" accept="image/*">
                                    <label class="custom-file-label" for="foto_firma" data-browse="Elegir archivo">Seleccionar imagen...</label>
                                </div>
                                <small class="form-text text-muted">Formatos: JPG, PNG, GIF. Máximo 2MB. Usada para recetar y diagnosticar.</small>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="text-right mt-3">
                            <button type="reset" class="btn btn-secondary mr-2">
                                <i class="fas fa-undo mr-1"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-danger px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i> Guardar Usuario
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
    <script src="{{ asset('js/admin/usuarios/create.js') }}"></script>
@endpush
