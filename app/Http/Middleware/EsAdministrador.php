<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EsAdministrador
{
    /**
     * Verifica que el usuario autenticado tenga rol de administrador.
     * Si no, redirige al dashboard de veterinario con un aviso 403.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->rol === 'administrador') {
            return $next($request);
        }

        abort(403, 'Acceso restringido a administradores.');
    }
}
