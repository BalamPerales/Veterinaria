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
            <h6 class="m-0 font-weight-bold text-danger">Lista de Expedientes</h6>
        </div>
        <div class="card-body">
            <div class="text-center text-muted py-4">
                <i class="fas fa-folder-open fa-3x mb-3 d-block text-gray-300"></i>
                Esta sección está en construcción. Aquí se mostrarán los expedientes clínicos.
            </div>
        </div>
    </div>
@endsection
