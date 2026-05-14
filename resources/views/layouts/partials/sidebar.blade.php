{{-- ============================================================
     SIDEBAR — Veterinaria
     Navegación lateral principal del sistema
============================================================ --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- ── Brand / Logo ── --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Veterinaria</div>
    </a>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider my-0">

    {{-- ── Dashboard ── --}}
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider">

    {{-- ── Heading: Módulos ── --}}
    <div class="sidebar-heading">
        Módulos
    </div>

    {{-- ── Pacientes ── --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePacientes"
            aria-expanded="false" aria-controls="collapsePacientes">
            <i class="fas fa-fw fa-dog"></i>
            <span>Pacientes</span>
        </a>
        <div id="collapsePacientes" class="collapse" aria-labelledby="headingPacientes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestión de pacientes:</h6>
                <a class="collapse-item" href="#">Ver pacientes</a>
                <a class="collapse-item" href="#">Nuevo paciente</a>
            </div>
        </div>
    </li>

    {{-- ── Propietarios ── --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePropietarios"
            aria-expanded="false" aria-controls="collapsePropietarios">
            <i class="fas fa-fw fa-users"></i>
            <span>Propietarios</span>
        </a>
        <div id="collapsePropietarios" class="collapse" aria-labelledby="headingPropietarios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestión de propietarios:</h6>
                <a class="collapse-item" href="#">Ver propietarios</a>
                <a class="collapse-item" href="#">Nuevo propietario</a>
            </div>
        </div>
    </li>

    {{-- ── Citas ── --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCitas"
            aria-expanded="false" aria-controls="collapseCitas">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Citas</span>
        </a>
        <div id="collapseCitas" class="collapse" aria-labelledby="headingCitas" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestión de citas:</h6>
                <a class="collapse-item" href="#">Ver citas</a>
                <a class="collapse-item" href="#">Nueva cita</a>
            </div>
        </div>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider">

    {{-- ── Heading: Sistema ── --}}
    <div class="sidebar-heading">
        Sistema
    </div>

    {{-- ── Usuarios ── --}}
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Usuarios</span>
        </a>
    </li>

    {{-- ── Divider ── --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{-- ── Sidebar Toggler ── --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
