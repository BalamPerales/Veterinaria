{{-- ============================================================
     SIDEBAR — Panel de Administración
     Navegación lateral del área de administradores
============================================================ --}}
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- ── Brand / Logo ── --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-shield-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup>VET</sup></div>
    </a>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider my-0">

    {{-- ── Dashboard ── --}}
    <li class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel Principal</span>
        </a>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider">

    {{-- ── Heading: Gestión ── --}}
    <div class="sidebar-heading">
        Gestión
    </div>

    {{-- ── Usuarios ── --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios"
            aria-expanded="false" aria-controls="collapseUsuarios">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUsuarios" class="collapse" aria-labelledby="headingUsuarios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestión de usuarios:</h6>
                <a class="collapse-item" href="#">Ver usuarios</a>
                <a class="collapse-item" href="#">Nuevo usuario</a>
            </div>
        </div>
    </li>

    {{-- ── Veterinarios ── --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVeterinarios"
            aria-expanded="false" aria-controls="collapseVeterinarios">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Veterinarios</span>
        </a>
        <div id="collapseVeterinarios" class="collapse" aria-labelledby="headingVeterinarios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestión de veterinarios:</h6>
                <a class="collapse-item" href="#">Ver veterinarios</a>
                <a class="collapse-item" href="#">Nuevo veterinario</a>
            </div>
        </div>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider">

    {{-- ── Heading: Sistema ── --}}
    <div class="sidebar-heading">
        Sistema
    </div>

    {{-- ── Reportes ── --}}
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Reportes</span>
        </a>
    </li>

    {{-- ── Configuración ── --}}
    <li class="nav-item {{ request()->routeIs('admin.configuracion') ? 'active' : '' }}">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Configuración</span>
        </a>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider">

    {{-- ── Heading: Cuenta ── --}}
    <div class="sidebar-heading">
        Cuenta
    </div>

    {{-- ── Mi Perfil ── --}}
    <li class="nav-item {{ request()->routeIs('admin.perfil') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.perfil') }}">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Mi Perfil</span>
        </a>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{-- ── Sidebar Toggler ── --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
