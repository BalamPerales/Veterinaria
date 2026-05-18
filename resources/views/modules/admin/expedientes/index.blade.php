@extends(Auth::check() && Auth::user()->rol === 'administrador' ? 'layouts.admin' : 'layouts.app')

@section('hide_sidebar', true)

@section('titulo_pagina', 'Expedientes Clínicos — Veterinaria')

@section('page_title', 'Expedientes Clínicos')

@section('page_actions')
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuevo Expediente
    </a>
@endsection

@section('contenido')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-search mr-2"></i>Búsqueda de Expedientes</h6>
        </div>
        <div class="card-body">
            
            <div class="row justify-content-center py-5">
                <div class="col-md-8 col-lg-7 text-center">
                    
                    {{-- Icono y Título --}}
                    <div class="mb-4">
                        <div class="icon-circle bg-primary-light d-inline-flex align-items-center justify-content-center rounded-circle p-4 mb-3 shadow-sm" style="background-color: rgba(78,115,223,0.1);">
                            <i class="fas fa-paw fa-3x text-primary"></i>
                        </div>
                        <h4 class="text-gray-800 font-weight-bold">Buscador de Expedientes</h4>
                        <p class="text-muted">Ingresa el nombre del propietario, teléfono, o nombre de la mascota para localizar su expediente médico.</p>
                    </div>

                    {{-- Control de Búsqueda --}}
                    <form action="{{ route('expedientes.index') }}" method="GET" class="form-group mb-5">
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                            <input type="text" name="q" value="{{ $query ?? '' }}" class="form-control border-0 bg-white px-4" placeholder="Buscar expediente..." aria-label="Buscar expediente" style="box-shadow: none;">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4 border-0" type="submit" style="border-radius: 0;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Botones de Acción --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center">
                        <button type="button" class="btn btn-primary btn-icon-split shadow-sm mb-3 mb-sm-0 mx-sm-2">
                            <span class="icon text-white-50">
                                <i class="fas fa-notes-medical"></i>
                            </span>
                            <span class="text">Ver consultas</span>
                        </button>
                        
                        <button type="button" class="btn btn-success btn-icon-split shadow-sm mx-sm-2">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Crear nuevo paciente o mascota</span>
                        </button>
                    </div>

                </div>
            </div>

            {{-- Resultados de la Búsqueda --}}
            @if(isset($mascotas))
                <div class="mt-2">
                    <h5 class="font-weight-bold text-gray-800 mb-3">Resultados para: "{{ $query }}"</h5>
                    
                    @if($mascotas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Mascota</th>
                                        <th>Especie / Raza</th>
                                        <th>Propietario</th>
                                        <th>Teléfono</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mascotas as $mascota)
                                        <tr>
                                            <td class="font-weight-bold text-primary">
                                                <i class="fas fa-paw mr-2 text-gray-400"></i>{{ $mascota->nombre }}
                                            </td>
                                            <td>{{ $mascota->especie }} <small class="text-muted">({{ $mascota->raza ?? 'N/A' }})</small></td>
                                            <td>
                                                <i class="fas fa-user mr-1 text-gray-400"></i>
                                                {{ $mascota->dueno->nombre_completo ?? 'Desconocido' }}
                                            </td>
                                            <td>{{ $mascota->dueno->telefono ?? 'Sin registro' }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-outline-primary shadow-sm">
                                                    <i class="fas fa-folder-open mr-1"></i> Abrir Expediente
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- Paginación --}}
                        <div class="d-flex justify-content-end mt-3">
                            {{ $mascotas->links() }}
                        </div>
                    @else
                        <div class="alert alert-warning text-center shadow-sm py-4">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3 text-warning"></i>
                            <h5 class="font-weight-bold">No se encontraron resultados</h5>
                            <p class="mb-0">No hay ninguna mascota ni propietario que coincida con "<strong>{{ $query }}</strong>". Intenta con otro término.</p>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
@endsection
