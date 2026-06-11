<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Muestra la lista de usuarios
     */
    public function index()
    {
        $usuarios = \App\Models\User::with('role')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario
     */
    public function create()
    {
        $roles = \App\Models\Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Guarda el nuevo usuario en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            return redirect()->route('admin.dashboard')->with('success', '¡Usuario creado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Hubo un fallo al crear el usuario. Inténtalo de nuevo.');
        }
    }
}
