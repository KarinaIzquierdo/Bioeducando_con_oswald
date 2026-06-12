<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProyectoPrae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyectoPraeController extends Controller
{
    public function index()
    {
        $proyectos = ProyectoPrae::latest()->get();
        return view('admin.prae.index', compact('proyectos'));
    }

    public function create()
    {
        return view('admin.prae.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('proyectos_prae/imagenes', 'public');
        }

        if ($request->hasFile('archivo_pdf')) {
            $data['archivo_pdf'] = $request->file('archivo_pdf')->store('proyectos_prae/documentos', 'public');
        }

        ProyectoPrae::create($data);

        return redirect()->route('admin.prae.index')->with('success', 'Proyecto PRAE publicado con éxito.');
    }

    public function edit($id)
    {
        $proyecto = ProyectoPrae::findOrFail($id);
        return view('admin.prae.edit', compact('proyecto'));
    }

    public function update(Request $request, $id)
    {
        $proyecto = ProyectoPrae::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($proyecto->imagen) Storage::disk('public')->delete($proyecto->imagen);
            $data['imagen'] = $request->file('imagen')->store('proyectos_prae/imagenes', 'public');
        }

        if ($request->hasFile('archivo_pdf')) {
            if ($proyecto->archivo_pdf) Storage::disk('public')->delete($proyecto->archivo_pdf);
            $data['archivo_pdf'] = $request->file('archivo_pdf')->store('proyectos_prae/documentos', 'public');
        }

        $proyecto->update($data);

        return redirect()->route('admin.prae.index')->with('success', 'Proyecto PRAE actualizado.');
    }

    public function destroy($id)
    {
        $proyecto = ProyectoPrae::findOrFail($id);
        if ($proyecto->imagen) Storage::disk('public')->delete($proyecto->imagen);
        if ($proyecto->archivo_pdf) Storage::disk('public')->delete($proyecto->archivo_pdf);
        $proyecto->delete();

        return redirect()->route('admin.prae.index')->with('success', 'Proyecto PRAE eliminado.');
    }
}
