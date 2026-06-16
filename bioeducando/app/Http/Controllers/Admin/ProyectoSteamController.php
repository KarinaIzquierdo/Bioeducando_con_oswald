<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProyectoSteam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyectoSteamController extends Controller
{
    public function index()
    {
        $proyectos = ProyectoSteam::latest()->get();
        return view('admin.steam.index', compact('proyectos'));
    }

    public function create()
    {
        return view('admin.steam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'objetivos' => 'nullable|string',
            'materiales' => 'nullable|string',
            'impacto_ambiental' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'destacado' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['estado'] = 'aprobado'; // Proyectos creados por admin se aprueban automáticamente
        $data['destacado'] = $request->has('destacado');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('proyectos_steam', 'public');
        }

        ProyectoSteam::create($data);

        return redirect()->route('admin.steam.index')->with('success', 'Proyecto STEAM creado con éxito.');
    }

    public function edit($id)
    {
        $proyecto = ProyectoSteam::findOrFail($id);
        return view('admin.steam.edit', compact('proyecto'));
    }

    public function update(Request $request, $id)
    {
        $proyecto = ProyectoSteam::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'objetivos' => 'nullable|string',
            'materiales' => 'nullable|string',
            'impacto_ambiental' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'estado' => 'required|in:pendiente,aprobado,rechazado',
            'destacado' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['destacado'] = $request->has('destacado');

        if ($request->hasFile('imagen')) {
            if ($proyecto->imagen) {
                Storage::disk('public')->delete($proyecto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('proyectos_steam', 'public');
        }

        $proyecto->update($data);

        return redirect()->route('admin.steam.index')->with('success', 'Proyecto STEAM actualizado con éxito.');
    }

    public function destroy($id)
    {
        $proyecto = ProyectoSteam::findOrFail($id);
        if ($proyecto->imagen) {
            Storage::disk('public')->delete($proyecto->imagen);
        }
        $proyecto->delete();

        return redirect()->route('admin.steam.index')->with('success', 'Proyecto STEAM eliminado con éxito.');
    }
}
