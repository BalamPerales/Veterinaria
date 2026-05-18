<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;

class ExpedienteController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');
        $mascotas = null;

        if ($query) {
            $mascotas = Mascota::with('dueno')
                ->where('nombre', 'like', "%{$query}%")
                ->orWhereHas('dueno', function ($q) use ($query) {
                    $q->where('nombre_completo', 'like', "%{$query}%")
                      ->orWhere('telefono', 'like', "%{$query}%");
                })
                ->paginate(10)
                ->appends(['q' => $query]);
        }

        return view('modules.admin.expedientes.index', compact('mascotas', 'query'));
    }
}
