<?php

namespace App\Http\Controllers;

use App\Models\Reto;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserRetoController extends Controller
{
    public function show($id)
    {
        $reto = Reto::findOrFail($id);
        
        // El reto comienza desde el día 0 hasta que se guarda la primera evidencia
        $diaActual = 0;
        $totalDias = 7;
        
        return view('retos.seguimiento', compact('reto', 'diaActual', 'totalDias'));
    }

    public function storeProgress(Request $request)
    {
        try {
            // Validación más permisiva para el tamaño del archivo
            $request->validate([
                'reto_id' => 'required|exists:retos,id',
                'dia_completado' => 'required|integer',
                'foto' => 'required|file|image|max:10240' // Aumentado a 10MB
            ]);

            $reto = Reto::find($request->reto_id);
            $user = auth()->user();

            $path = null;
            if ($request->hasFile('foto')) {
                // Asegurarnos de que el nombre sea único y vaya a la carpeta correcta
                $path = $request->file('foto')->store('comunidad', 'public');
                
                // Crear la publicación usando el modelo directamente
                $publicacion = new Publicacion();
                $publicacion->user_id = $user->id;
                
                // Usar solo el comentario del usuario si lo escribió, sino usar uno por defecto
                if ($request->comentario) {
                    $publicacion->contenido = $request->comentario . "\n\n#Día{$request->dia_completado} #{$reto->titulo} #Bioeducando";
                } else {
                    $publicacion->contenido = "¡He completado el Día {$request->dia_completado} del reto: {$reto->titulo}! 🌱💪\n\n#Bioeducando #RetoEcologico";
                }
                
                $publicacion->media_path = $path;
                $publicacion->media_type = 'image';
                $publicacion->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Progreso guardado y compartido en la comunidad',
                'path' => $path
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
