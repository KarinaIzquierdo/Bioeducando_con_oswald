<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reto;

class RetoController extends Controller
{
    public function index()
    {
        $retos = Reto::all();
        // Si no hay retos, creamos uno de prueba para que no se vea vacío
        if ($retos->isEmpty()) {
            Reto::create([
                'titulo' => 'Clasificador experto',
                'descripcion' => 'Separa correctamente residuos orgánicos, reciclables y no reciclables durante una semana.',
                'estado' => 'activa',
                'categoria' => 'reciclaje',
                'dificultad' => 'intermedio',
                'puntos' => 100,
                'duracion' => '7 días',
                'evidencias' => ['foto', 'reflexion'],
                'insignia' => 'experto'
            ]);
            $retos = Reto::all();
        }
        return view('admin.retos.index', compact('retos'));
    }

    public function edit($id)
    {
        $reto = Reto::findOrFail($id);
        return view('admin.retos.edit', compact('reto'));
    }

    public function create()
    {
        return view('admin.retos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required',
            'categoria' => 'required',
            'dificultad' => 'required',
            'puntos' => 'required|numeric',
            'duracion' => 'required',
            'insignia' => 'required'
        ]);

        Reto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'categoria' => $request->categoria,
            'dificultad' => $request->dificultad,
            'puntos' => $request->puntos,
            'duracion' => $request->duracion,
            'evidencias' => $request->evidencias,
            'insignia' => $request->insignia
        ]);

        return redirect()->route('admin.retos')->with('success', '¡Nuevo reto creado correctamente!');
    }

    public function update(Request $request, $id)
    {
        $reto = Reto::findOrFail($id);
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required',
            'categoria' => 'required',
            'dificultad' => 'required',
            'puntos' => 'required|numeric',
            'duracion' => 'required',
            'insignia' => 'required'
        ]);

        $reto->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'categoria' => $request->categoria,
            'dificultad' => $request->dificultad,
            'puntos' => $request->puntos,
            'duracion' => $request->duracion,
            'evidencias' => $request->evidencias,
            'insignia' => $request->insignia
        ]);

        return redirect()->route('admin.retos')->with('success', '¡Misión actualizada correctamente!');
    }
}
