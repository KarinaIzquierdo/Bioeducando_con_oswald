<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reto;
use App\Models\Publicacion;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $queryLower = strtolower(trim($query));

        if (empty($query)) {
            return redirect()->back();
        }

        // Redirecciones directas si busca los nombres de los módulos
        if ($queryLower === 'comunidad ambiental' || $queryLower === 'comunidad') {
            return redirect()->route('comunidad.publica');
        }

        if ($queryLower === 'retos ecologicos' || $queryLower === 'retos' || $queryLower === 'reto') {
            return redirect()->route('retos.publica');
        }

        // Si no es una búsqueda exacta de módulo, buscar en los contenidos
        // Buscar en Retos
        $retos = Reto::where('titulo', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->where('estado', 'activa')
            ->get();

        // Buscar en Publicaciones de Comunidad
        $publicaciones = Publicacion::with('user')
            ->where('contenido', 'LIKE', "%{$query}%")
            ->latest()
            ->get();

        return view('search.results', compact('retos', 'publicaciones', 'query'));
    }
}
