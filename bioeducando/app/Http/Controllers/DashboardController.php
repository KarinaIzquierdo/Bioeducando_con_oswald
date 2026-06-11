<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Cargamos la relación del rol para estar seguros
        $user->load('role');

        if ($user->role && $user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role && $user->role->name === 'docente') {
            return redirect()->route('docente.dashboard');
        }

        // Si es un usuario normal o no tiene rol, se queda en el home
        return view('home');
    }
}
