<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComunidadController extends Controller
{
    public function index()
    {
        // Cargamos las publicaciones con sus usuarios y sus comentarios
        $publicaciones = Publicacion::with(['user', 'comentarios.user'])->latest()->get();
        return view('admin.comunidad.index', compact('publicaciones'));
    }

    public function store(Request $request)
    {
        $messages = [
            'contenido.required' => 'La descripción es obligatoria.',
            'pdf.max' => 'El archivo PDF no debe pesar más de 20MB.',
            'media.max' => 'El archivo multimedia no debe pesar más de 25MB.',
        ];

        $request->validate([
            'contenido' => 'required|string',
            'media' => 'nullable|file|max:25600', // 25MB
            'pdf' => 'nullable|file|max:20480',   // 20MB
        ], $messages);

        $mediaPath = null;
        $mediaType = null;

        // Primero verificar si subió un PDF (prioridad)
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $mediaPath = $file->store('comunidad', 'public');
            $mediaType = 'pdf';
        } elseif ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaPath = $file->store('comunidad', 'public');
            $mediaType = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';
        }

        Publicacion::create([
            'user_id' => Auth::id(),
            'contenido' => $request->contenido,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
        ]);

        if (Auth::user()->role && Auth::user()->role->name == 'admin') {
            return redirect()->route('admin.comunidad_activa')->with('success', '¡Publicación compartida con éxito!');
        }

        return redirect()->route('comunidad.usuario')->with('success', '¡Publicación compartida con éxito!');
    }

    public function destroy($id)
    {
        $post = Publicacion::findOrFail($id);

        // Solo el dueño o el admin pueden borrar
        if (Auth::id() != $post->user_id && Auth::user()->role->name != 'admin') {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta publicación.');
        }

        // Borrar el archivo si existe
        if ($post->media_path) {
            Storage::disk('public')->delete($post->media_path);
        }

        $post->delete();

        // Redirigir según el rol del usuario para que no caigan en la vista equivocada
        if (Auth::user()->role && Auth::user()->role->name == 'admin') {
            return redirect()->route('admin.comunidad_activa')->with('success', 'Publicación eliminada correctamente.');
        }

        return redirect()->route('comunidad.usuario')->with('success', 'Publicación eliminada correctamente.');
    }

    public function toggleLike(Request $request, $id)
    {
        $post = Publicacion::findOrFail($id);
        $action = $request->input('action'); // 'like' or 'unlike'

        if ($action === 'like') {
            $post->increment('likes_count');
        } elseif ($action === 'unlike') {
            $post->decrement('likes_count');
            if ($post->likes_count < 0) {
                $post->likes_count = 0;
                $post->save();
            }
        }

        return response()->json([
            'success' => true,
            'likes_count' => $post->likes_count
        ]);
    }
}
