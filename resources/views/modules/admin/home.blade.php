@extends('layouts.admin')

@section('titulo_pagina', 'Panel de Administración — Veterinaria')

@section('page_title', 'Panel de Administración')

@section('page_actions')
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-file-export fa-sm text-white-50 mr-1"></i> Exportar reporte
    </a>
@endsection

@section('contenido')

    {{-- ── Fila de tarjetas de resumen ── --}}
    <div class="row">

        {{-- Usuarios registrados --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Usuarios Registrados</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Veterinarios activos --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Veterinarios Activos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Administradores --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Administradores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shield-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Accesos recientes --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Accesos Recientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- /.row --}}

    {{-- ── Fila informativa ── --}}
    <div class="row">

        {{-- Panel de bienvenida --}}
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex align-items-center">
                    <i class="fas fa-shield-alt text-danger mr-2"></i>
                    <h6 class="m-0 font-weight-bold text-danger">Área de Administración</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Bienvenido al panel de administración de <strong>Veterinaria</strong>.
                        Desde aquí puedes gestionar usuarios, veterinarios y la configuración general del sistema.
                    </p>
                </div>
            </div>
        </div>

    </div>
    {{-- /.row --}}

@endsection
