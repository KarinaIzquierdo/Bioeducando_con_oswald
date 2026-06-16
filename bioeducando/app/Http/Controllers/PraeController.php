<?php

namespace App\Http\Controllers;

use App\Models\PraeInformacion;
use App\Models\PraeActividad;
use App\Models\PraeDocumento;
use Illuminate\Http\Request;

class PraeController extends Controller
{
    public function index()
    {
        $info = PraeInformacion::first();
        $actividadesProximas = PraeActividad::where('estado', 'proxima')->orderBy('fecha', 'asc')->get();
        $actividadesRealizadas = PraeActividad::where('estado', 'finalizada')->orderBy('fecha', 'desc')->get();
        $documentos = PraeDocumento::latest()->get();

        return view('prae.index', compact('info', 'actividadesProximas', 'actividadesRealizadas', 'documentos'));
    }
}
