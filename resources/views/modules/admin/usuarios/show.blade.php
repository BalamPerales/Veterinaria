@extends('layouts.admin')

@section('titulo_pagina', 'Confirmar Eliminación — Veterinaria')

@section('page_title', 'Eliminar Usuario: ' . $usuario->name)

@section('page_actions')
    <a href="{{ route('admin.usuarios.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Cancelar y Volver
    </a>
@endsection

@section('contenido')

    {{-- Mostrar errores si los hay --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
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

    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            {{-- Alertas según la posibilidad de eliminar --}}
            @if($puedeEliminar)
                <div class="alert alert-danger shadow-sm border-left-danger mb-4">
                    <h4 class="alert-heading font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i>¡Peligro! Acción Destructiva</h4>
                    <p>Estás a punto de eliminar permanentemente al usuario <strong>{{ $usuario->name }}</strong> del sistema.</p>
                    <hr>
                    <p class="mb-0">Esta acción no se puede deshacer. Se perderán sus credenciales de acceso y, en caso de ser veterinario, su perfil y firma. Revisa bien la información antes de continuar.</p>
                </div>
            @else
                <div class="alert alert-warning shadow-sm border-left-warning mb-4">
                    <h4 class="alert-heading font-weight-bold"><i class="fas fa-hand-paper mr-2"></i>No se puede eliminar</h4>
                    <p class="mb-0">{{ $mensajeDependencia }}</p>
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-gray-800"><i class="fas fa-info-circle mr-2"></i>Resumen de Información</h6>
                </div>
                
                <div class="card-body">
                    <div class="row mb-3 border-bottom pb-3">
                        <div class="col-sm-4 text-muted font-weight-bold">ID de Sistema:</div>
                        <div class="col-sm-8">{{ $usuario->id }}</div>
                    </div>
                    
                    <div class="row mb-3 border-bottom pb-3">
                        <div class="col-sm-4 text-muted font-weight-bold">Nombre Completo:</div>
                        <div class="col-sm-8">{{ $usuario->name }}</div>
                    </div>
                    
                    <div class="row mb-3 border-bottom pb-3">
                        <div class="col-sm-4 text-muted font-weight-bold">Correo Electrónico:</div>
                        <div class="col-sm-8">{{ $usuario->email }}</div>
                    </div>

                    <div class="row mb-3 border-bottom pb-3">
                        <div class="col-sm-4 text-muted font-weight-bold">Rol:</div>
                        <div class="col-sm-8 text-capitalize">
                            @if ($usuario->rol === 'administrador')
                                <span class="badge badge-danger px-2 py-1"><i class="fas fa-shield-alt mr-1"></i> {{ $usuario->rol }}</span>
                            @else
                                <span class="badge badge-info px-2 py-1"><i class="fas fa-user-md mr-1"></i> {{ $usuario->rol }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3 border-bottom pb-3">
                        <div class="col-sm-4 text-muted font-weight-bold">Estado:</div>
                        <div class="col-sm-8">
                            @if ($usuario->activo)
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Activo</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1"><i class="fas fa-times-circle mr-1"></i> Inactivo</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3 pb-2">
                        <div class="col-sm-4 text-muted font-weight-bold">Fecha de Registro:</div>
                        <div class="col-sm-8">{{ $usuario->created_at->format('d/m/Y H:i') }} (Hace {{ $usuario->created_at->diffForHumans() }})</div>
                    </div>

                    {{-- Datos adicionales si es veterinario --}}
                    @if($usuario->rol === 'veterinario' && $usuario->veterinario)
                        <div class="bg-light p-3 rounded border mt-4">
                            <h6 class="font-weight-bold text-info border-bottom pb-2 mb-3">Datos del Perfil Veterinario</h6>
                            
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted font-weight-bold">Especialidad:</div>
                                <div class="col-sm-8">{{ $usuario->veterinario->especialidad ?: 'No especificada' }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted font-weight-bold">Cédula:</div>
                                <div class="col-sm-8">{{ $usuario->veterinario->cedula_profesional ?: 'No especificada' }}</div>
                            </div>

                            @if($usuario->veterinario->foto_firma)
                                <div class="row mt-3">
                                    <div class="col-sm-4 text-muted font-weight-bold">Firma Adjunta:</div>
                                    <div class="col-sm-8">
                                        <img src="{{ Storage::url($usuario->veterinario->foto_firma) }}" alt="Firma" class="img-thumbnail" style="max-height: 60px;">
                                        <small class="d-block text-danger mt-1"><i class="fas fa-trash fa-sm"></i> Se eliminará este archivo del servidor.</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                
                {{-- Botones de Acción --}}
                <div class="card-footer bg-white text-right py-3">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </a>
                    
                    @if($puedeEliminar)
                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger shadow-sm">
                                <i class="fas fa-trash-alt mr-1"></i> Sí, Eliminar Definitivamente
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
