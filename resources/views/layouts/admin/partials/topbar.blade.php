{{-- ============================================================
     TOPBAR — Panel de Administración
     Barra de navegación superior del área de administradores
============================================================ --}}
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    {{-- ── Sidebar Toggle (visible solo en móvil) ── --}}
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- ── Título del Sistema ── --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center mr-3 text-decoration-none" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon rotate-n-15 text-danger">
            <i class="fas fa-paw fa-2x"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-danger font-weight-bold h5 mb-0">VETERINARIA</div>
    </a>


    {{-- ── Enlaces Rápidos Topbar ── --}}
    <ul class="navbar-nav mr-auto ml-4 d-none d-md-flex align-items-center">
        <li class="nav-item {{ request()->routeIs('expedientes.*') ? 'active' : '' }}">
            <a class="nav-link font-weight-bold {{ request()->routeIs('expedientes.*') ? 'text-danger' : 'text-gray-800' }}" href="{{ route('expedientes.index') }}">
                <i class="fas fa-folder-open mr-1"></i> Expedientes
            </a>
        </li>
    </ul>

    {{-- ── Right Navbar ── --}}
    <ul class="navbar-nav ml-auto">


        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- ── Dropdown: Usuario Administrador ── --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="adminUserDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::user()->name ?? 'Administrador' }}
                    <span class="badge badge-danger ml-1">Admin</span>
                </span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/img/undraw_profile.svg') }}">
            </a>
            {{-- Dropdown: Info de usuario --}}
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="adminUserDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>

    </ul>

</nav>
