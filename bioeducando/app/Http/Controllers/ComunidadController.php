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
        // Cargamos las publicaciones con sus usuarios y sus comentarios (con los autores de los comentarios)
        $publicaciones = Publicacion::with(['user', 'comentarios.user'])->latest()->get();
        return view('admin.comunidad.index', compact('publicaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480', // Máx 20MB
        ]);

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
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

        return redirect()->route('admin.comunidad')->with('success', '¡Publicación compartida con éxito!');
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
            return redirect()->route('admin.comunidad')->with('success', 'Publicación eliminada correctamente.');
        }

        return redirect()->route('comunidad.publica')->with('success', 'Publicación eliminada correctamente.');
    }
}
