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
                    <form action="{{ route('expedientes.index') }}" method="GET" class="form-group mb-5 position-relative">
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                            <input type="text" name="q" id="searchInput" value="{{ $query ?? '' }}" autocomplete="off" class="form-control border-0 bg-white px-4" placeholder="Buscar por nombre o folio..." aria-label="Buscar expediente" style="box-shadow: none;">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4 border-0" type="submit" style="border-radius: 0;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        {{-- Caja de Sugerencias JS --}}
                        <div id="searchSuggestions" class="position-absolute w-100 bg-white shadow-lg rounded mt-1 d-none" style="z-index: 1000; text-align: left; max-height: 300px; overflow-y: auto;">
                            <!-- Los resultados se inyectarán aquí -->
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('searchInput');
        const suggestionsBox = document.getElementById('searchSuggestions');
        let timeout = null;

        input.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = this.value.trim();

            if (query.length < 2) {
                suggestionsBox.classList.add('d-none');
                suggestionsBox.innerHTML = '';
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/api/expedientes/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionsBox.innerHTML = '';
                        if (data.length > 0) {
                            let html = '<ul class="list-group list-group-flush">';
                            data.forEach(item => {
                                html += `
                                    <li class="list-group-item list-group-item-action suggestion-item" style="cursor: pointer;" data-name="${item.nombre}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong><i class="fas fa-paw mr-1 text-primary"></i>${item.nombre}</strong>
                                                <small class="d-block text-muted">Dueño: ${item.dueno}</small>
                                            </div>
                                            <span class="badge badge-light badge-pill text-muted">Folio #${item.id}</span>
                                        </div>
                                    </li>
                                `;
                            });
                            html += '</ul>';
                            suggestionsBox.innerHTML = html;
                            suggestionsBox.classList.remove('d-none');

                            // Click en sugerencia -> llenar input y enviar form
                            document.querySelectorAll('.suggestion-item').forEach(el => {
                                el.addEventListener('click', function() {
                                    input.value = this.getAttribute('data-name');
                                    suggestionsBox.classList.add('d-none');
                                    input.closest('form').submit();
                                });
                            });
                        } else {
                            suggestionsBox.innerHTML = '<div class="p-3 text-muted text-center"><small>No se encontraron resultados inmediatos.</small></div>';
                            suggestionsBox.classList.remove('d-none');
                        }
                    })
                    .catch(err => console.error("Error fetching search results:", err));
            }, 300); // 300ms debounce
        });

        // Ocultar al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('d-none');
            }
        });
    });
</script>
@endpush
