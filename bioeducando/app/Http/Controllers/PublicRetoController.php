<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reto;

class PublicRetoController extends Controller
{
    public function index()
    {
        $retos = Reto::where('estado', 'activa')->get();
        return view('retos.publica', compact('retos'));
    }
}
