@extends('layouts.admin')

@section('titulo_pagina', 'Gestión de Usuarios — Veterinaria')

@section('page_title', 'Usuarios Registrados')

@section('page_actions')
    <a href="{{ route('admin.usuarios.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuevo Usuario
    </a>
@endsection

@section('contenido')

    {{-- Mostrar mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Tarjeta de la Tabla --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-list mr-2"></i>Lista de Usuarios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTableUsuarios" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td class="font-weight-bold text-gray-800">
                                    {{ $usuario->name }}
                                    @if ($usuario->id === Auth::id())
                                        <span class="badge badge-secondary ml-1">Tú</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->email }}</td>
                                <td class="text-capitalize">
                                    @if ($usuario->rol === 'administrador')
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-shield-alt mr-1"></i> {{ $usuario->rol }}</span>
                                    @else
                                        <span class="badge badge-info px-2 py-1"><i class="fas fa-user-md mr-1"></i> {{ $usuario->rol }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($usuario->activo)
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Activo</span>
                                    @else
                                        <span class="badge badge-secondary px-2 py-1"><i class="fas fa-times-circle mr-1"></i> Inactivo</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    {{-- Botones de Acción (Iconos) --}}
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-sm btn-outline-info" title="Ver Detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.usuarios.show', $usuario) }}" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block text-gray-300"></i>
                                    No hay usuarios registrados en el sistema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    {{-- DataTables CSS (Usando los provistos por SB Admin 2 si existen, o CDN) --}}
    <link href="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTableUsuarios').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                "pageLength": 5, // Paginación de 5 en 5 por defecto
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]], // Opciones del selector
                "order": [[0, "desc"]], // Ordenar por ID descendente por defecto
                "columnDefs": [
                    { "orderable": false, "targets": 6 } // Desactivar ordenación en la columna de acciones
                ]
            });
        });
    </script>
@endpush
