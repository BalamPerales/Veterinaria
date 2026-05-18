<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Módulo de Expedientes
    Route::get('/expedientes', [\App\Http\Controllers\ExpedienteController::class, 'index'])->name('expedientes.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home',   [AdminController::class, 'home'])  ->name('home');
    Route::get('/perfil', [AdminController::class, 'perfil'])->name('perfil');

    // Módulo de Usuarios
    Route::get('/usuarios', [\App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [\App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [\App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}/editar', [\App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show');
    Route::delete('/usuarios/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});
