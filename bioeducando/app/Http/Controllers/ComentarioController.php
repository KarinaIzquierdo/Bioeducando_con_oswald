<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:500',
            'publicacion_id' => 'required|exists:publicacions,id'
        ]);

        try {
            Comentario::create([
                'contenido' => $request->contenido,
                'publicacion_id' => $request->publicacion_id,
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('success', '¡Comentario publicado!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al publicar el comentario.');
        }
    }
}
