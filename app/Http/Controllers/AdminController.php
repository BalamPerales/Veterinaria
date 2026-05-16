<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Dashboard principal del administrador.
     */
    public function home()
    {
        return view('modules/admin/home');
    }

    /**
     * Perfil / Menú de usuario del administrador.
     */
    public function perfil()
    {
        return view('modules/admin/perfil');
    }
}
