<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PraeInformacion;
use App\Models\PraeActividad;
use App\Models\PraeDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PraeController extends Controller
{
    public function index()
    {
        $info = PraeInformacion::first();
        $actividades = PraeActividad::latest()->get();
        $documentos = PraeDocumento::latest()->get();
        
        return view('admin.prae.index', compact('info', 'actividades', 'documentos'));
    }

    // Gestión de Información
    public function updateInfo(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'objetivos' => 'required|string',
        ]);

        $info = PraeInformacion::first() ?? new PraeInformacion();
        $info->descripcion = $request->descripcion;
        $info->objetivos = $request->objetivos;
        $info->save();

        return back()->with('success', 'Información del PRAE actualizada.');
    }

    // Gestión de Actividades
    public function storeActividad(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'estado' => 'required|in:proxima,finalizada',
        ]);

        PraeActividad::create($request->all());

        return back()->with('success', 'Actividad ambiental creada.');
    }

    public function updateActividad(Request $request, PraeActividad $actividad)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'estado' => 'required|in:proxima,finalizada',
        ]);

        $actividad->update($request->all());

        return back()->with('success', 'Actividad actualizada.');
    }

    public function destroyActividad(PraeActividad $actividad)
    {
        $actividad->delete();
        return back()->with('success', 'Actividad eliminada.');
    }

    // Gestión de Documentos
    public function storeDocumento(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'archivo' => 'required|mimes:pdf|max:10240', // PDF hasta 10MB
        ]);

        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('prae_documentos', 'public');
            PraeDocumento::create([
                'titulo' => $request->titulo,
                'archivo_path' => $path
            ]);
        }

        return back()->with('success', 'Documento subido con éxito.');
    }

    public function destroyDocumento(PraeDocumento $documento)
    {
        if (Storage::disk('public')->exists($documento->archivo_path)) {
            Storage::disk('public')->delete($documento->archivo_path);
        }
        $documento->delete();
        return back()->with('success', 'Documento eliminado.');
    }
}
