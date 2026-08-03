<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Reto;
use App\Models\Publicacion;

class DashboardController extends Controller
{
    public function admin()
    {
        // Estadísticas reales
        $totalUsuarios = User::count();
        $totalRetos = Reto::where('estado', 'activa')->count();
        $interaccionesHoy = Publicacion::whereDate('created_at', today())->count();

        // Actividad reciente real
        $actividadUsuarios = User::latest()->take(2)->get()->map(function($user) {
            return [
                'texto' => "Nuevo usuario registrado: <b>{$user->name}</b>",
                'tiempo' => $user->created_at->diffForHumans(),
                'color' => '#6ab06a'
            ];
        });

        $actividadPublicaciones = Publicacion::with('user')->latest()->take(3)->get()->map(function($post) {
            return [
                'texto' => " publicación Nuevade <b>" . ($post->user->name ?? 'Usuario') . "</b> en la comunidad",
                'tiempo' => $post->created_at->diffForHumans(),
                'color' => '#3b82f6'
            ];
        });

        // Combinar y ordenar actividades por fecha
        $actividades = $actividadUsuarios->concat($actividadPublicaciones)->sortByDesc('created_at')->take(5);

        return view('admin.dashboard', compact('totalUsuarios', 'totalRetos', 'interaccionesHoy', 'actividades'));
    }

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

        // Al iniciar sesión, el usuario normal irá directamente a la Comunidad Ambiental (panel de usuario)
        return redirect()->route('comunidad.usuario');
    }
}
