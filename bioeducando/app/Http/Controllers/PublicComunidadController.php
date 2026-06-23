<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Publicacion;

class PublicComunidadController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('comunidad.usuario');
        }

        // Cargamos las publicaciones con sus usuarios y sus comentarios (con los autores de los comentarios)
        $publicaciones = Publicacion::with(['user', 'comentarios' => function($query) {
            $query->with('user')->latest();
        }])->latest()->get();

        return view('comunidad.publica', compact('publicaciones'));
    }
}
