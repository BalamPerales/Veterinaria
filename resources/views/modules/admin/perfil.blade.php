@extends('layouts.admin')

@section('titulo_pagina', 'Mi Perfil — Veterinaria')

@section('page_title', 'Mi Perfil')

@section('page_actions')
    <a href="{{ route('admin.home') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Volver al Panel
    </a>
@endsection

@section('contenido')

    {{-- ── Fila principal ── --}}
    <div class="row">

        {{-- ── Tarjeta de información del usuario ── --}}
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow">
                {{-- Cabecera con avatar --}}
                <div class="card-header py-3 bg-gradient-danger text-center">
                    <div class="mt-3 mb-2">
                        <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center"
                             style="width:80px;height:80px;background:rgba(255,255,255,.2);font-size:2rem;color:#fff;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    <h5 class="font-weight-bold text-white mb-1">{{ Auth::user()->name }}</h5>
                    <span class="badge badge-light px-3 py-1">
                        <i class="fas fa-shield-alt mr-1 text-danger"></i>
                        Administrador
                    </span>
                </div>

                {{-- Datos básicos --}}
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-uppercase text-muted">
                                <i class="fas fa-envelope mr-1 text-danger"></i> Correo
                            </span>
                            <span class="font-weight-bold text-gray-800">{{ Auth::user()->email }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-uppercase text-muted">
                                <i class="fas fa-id-badge mr-1 text-danger"></i> Rol
                            </span>
                            <span class="font-weight-bold text-capitalize text-gray-800">{{ Auth::user()->role }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-uppercase text-muted">
                                <i class="fas fa-calendar-alt mr-1 text-danger"></i> Miembro desde
                            </span>
                            <span class="font-weight-bold text-gray-800">
                                {{ Auth::user()->created_at->format('d/m/Y') }}
                            </span>
                        </li>
                    </ul>

                    <hr>

                    {{-- Acciones rápidas --}}
                    <div class="d-flex flex-column gap-2">
                        <a href="#modalCambiarPassword" data-toggle="modal"
                           class="btn btn-danger btn-block btn-sm">
                            <i class="fas fa-key mr-1"></i> Cambiar Contraseña
                        </a>
                        <a href="{{ route('logout') }}"
                           class="btn btn-outline-secondary btn-block btn-sm"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-1"></i> Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none"></form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Columna derecha ── --}}
        <div class="col-xl-8 col-lg-7">

            {{-- ── Tarjeta: Editar información ── --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <i class="fas fa-user-edit text-danger mr-2"></i>
                    <h6 class="m-0 font-weight-bold text-danger">Información de la Cuenta</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="#">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="font-weight-bold text-xs text-uppercase text-muted">
                                    Nombre completo
                                </label>
                                <input type="text" id="nombre" name="name"
                                       class="form-control form-control-sm"
                                       value="{{ Auth::user()->name }}"
                                       placeholder="Tu nombre completo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold text-xs text-uppercase text-muted">
                                    Correo electrónico
                                </label>
                                <input type="email" id="email" name="email"
                                       class="form-control form-control-sm"
                                       value="{{ Auth::user()->email }}"
                                       placeholder="correo@ejemplo.com">
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-save mr-1"></i> Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Tarjeta: Estadísticas de actividad ── --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <i class="fas fa-chart-line text-danger mr-2"></i>
                    <h6 class="m-0 font-weight-bold text-danger">Actividad del Sistema</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="border-right">
                                <div class="h4 font-weight-bold text-danger mb-0">—</div>
                                <small class="text-xs text-uppercase text-muted font-weight-bold">Sesiones</small>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="border-right">
                                <div class="h4 font-weight-bold text-warning mb-0">—</div>
                                <small class="text-xs text-uppercase text-muted font-weight-bold">Acciones</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="h4 font-weight-bold text-success mb-0">—</div>
                            <small class="text-xs text-uppercase text-muted font-weight-bold">Último acceso</small>
                        </div>
                    </div>
                    <hr>
                    <p class="text-center text-muted mb-0" style="font-size:.85rem;">
                        <i class="fas fa-info-circle mr-1"></i>
                        Las estadísticas detalladas estarán disponibles próximamente.
                    </p>
                </div>
            </div>

            {{-- ── Tarjeta: Accesos rápidos ── --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <i class="fas fa-th-large text-danger mr-2"></i>
                    <h6 class="m-0 font-weight-bold text-danger">Accesos Rápidos</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <a href="{{ route('admin.home') }}"
                               class="btn btn-outline-danger btn-block btn-sm text-left">
                                <i class="fas fa-tachometer-alt mr-2"></i> Panel Principal
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <a href="#" class="btn btn-outline-secondary btn-block btn-sm text-left">
                                <i class="fas fa-users-cog mr-2"></i> Gestión Usuarios
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <a href="#" class="btn btn-outline-secondary btn-block btn-sm text-left">
                                <i class="fas fa-user-md mr-2"></i> Veterinarios
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <a href="#" class="btn btn-outline-secondary btn-block btn-sm text-left">
                                <i class="fas fa-chart-bar mr-2"></i> Reportes
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <a href="#" class="btn btn-outline-secondary btn-block btn-sm text-left">
                                <i class="fas fa-cogs mr-2"></i> Configuración
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- /.col-xl-8 --}}

    </div>
    {{-- /.row --}}

    {{-- ── Modal: Cambiar Contraseña ── --}}
    <div class="modal fade" id="modalCambiarPassword" tabindex="-1" role="dialog"
         aria-labelledby="modalCambiarPasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title text-white font-weight-bold" id="modalCambiarPasswordLabel">
                        <i class="fas fa-key mr-2"></i> Cambiar Contraseña
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="#">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password_actual" class="font-weight-bold text-xs text-uppercase text-muted">
                                Contraseña actual
                            </label>
                            <input type="password" id="password_actual" name="password_actual"
                                   class="form-control form-control-sm"
                                   placeholder="••••••••" required>
                        </div>
                        <div class="form-group">
                            <label for="nueva_password" class="font-weight-bold text-xs text-uppercase text-muted">
                                Nueva contraseña
                            </label>
                            <input type="password" id="nueva_password" name="password"
                                   class="form-control form-control-sm"
                                   placeholder="••••••••" required>
                        </div>
                        <div class="form-group mb-0">
                            <label for="confirmar_password" class="font-weight-bold text-xs text-uppercase text-muted">
                                Confirmar nueva contraseña
                            </label>
                            <input type="password" id="confirmar_password" name="password_confirmation"
                                   class="form-control form-control-sm"
                                   placeholder="••••••••" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-save mr-1"></i> Actualizar contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
