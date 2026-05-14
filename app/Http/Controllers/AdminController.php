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
}
