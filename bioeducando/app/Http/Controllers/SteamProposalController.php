<?php

namespace App\Http\Controllers;

use App\Models\ProyectoSteam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SteamProposalController extends Controller
{
    public function create()
    {
        return view('steam.proponer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'objetivos' => 'required|string',
            'materiales' => 'required|string',
            'impacto_ambiental' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['estado'] = 'pendiente';
        $data['destacado'] = false;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('proyectos_steam', 'public');
        }

        ProyectoSteam::create($data);

        return redirect()->route('steam.mis_propuestas')->with('success', 'Tu propuesta de proyecto STEAM ha sido enviada con éxito y está pendiente de revisión.');
    }

    public function myProposals()
    {
        $propuestas = ProyectoSteam::where('user_id', Auth::id())->latest()->get();
        return view('steam.mis_propuestas', compact('propuestas'));
    }
}
