<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('user')->latest()->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'antetitulo' => 'nullable|string|max:255',
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'nullable|string',
            'entradilla' => 'required|string',
            'cuerpo' => 'required|string',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,pdf|max:10240',
            'pie_foto' => 'nullable|string|max:255',
            'fecha_publicacion' => 'required|date',
            'categoria' => 'required|string|max:100',
            'estado' => 'required|in:activa,inactiva',
        ]);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('noticias', 'public');
        }

        Noticia::create([
            'user_id' => Auth::id(),
            'antetitulo' => $request->antetitulo,
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'entradilla' => $request->entradilla,
            'cuerpo' => $request->cuerpo,
            'imagen' => $imagenPath,
            'pie_foto' => $request->pie_foto,
            'fecha_publicacion' => $request->fecha_publicacion,
            'categoria' => $request->categoria,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.noticias')->with('success', '¡Noticia creada correctamente!');
    }

    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);

        $request->validate([
            'antetitulo' => 'nullable|string|max:255',
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'nullable|string',
            'entradilla' => 'required|string',
            'cuerpo' => 'required|string',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,pdf|max:10240',
            'pie_foto' => 'nullable|string|max:255',
            'fecha_publicacion' => 'required|date',
            'categoria' => 'required|string|max:100',
            'estado' => 'required|in:activa,inactiva',
        ]);

        $imagenPath = $noticia->imagen;
        if ($request->hasFile('imagen')) {
            if ($imagenPath) {
                Storage::disk('public')->delete($imagenPath);
            }
            $imagenPath = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update([
            'antetitulo' => $request->antetitulo,
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'entradilla' => $request->entradilla,
            'cuerpo' => $request->cuerpo,
            'imagen' => $imagenPath,
            'pie_foto' => $request->pie_foto,
            'fecha_publicacion' => $request->fecha_publicacion,
            'categoria' => $request->categoria,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.noticias')->with('success', '¡Noticia actualizada correctamente!');
    }

    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        if ($noticia->imagen) {
            Storage::disk('public')->delete($noticia->imagen);
        }
        $noticia->delete();

        return redirect()->route('admin.noticias')->with('success', '¡Noticia eliminada correctamente!');
    }

    public function toggleLike($id)
    {
        $noticia = Noticia::findOrFail($id);
        $userId = Auth::id();

        if ($userId) {
            // Usuario autenticado: toggle con tracking
            $like = \App\Models\NoticiaLike::where('user_id', $userId)->where('noticia_id', $id)->first();

            if ($like) {
                $like->delete();
                $noticia->decrement('likes_count');
                $liked = false;
            } else {
                \App\Models\NoticiaLike::create(['user_id' => $userId, 'noticia_id' => $id]);
                $noticia->increment('likes_count');
                $liked = true;
            }
        } else {
            // Visitante anónimo: solo incrementa
            $noticia->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $noticia->fresh()->likes_count
        ]);
    }

    public function comentar(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:1000',
        ]);

        $comentario = \App\Models\NoticiaComentario::create([
            'user_id' => Auth::id(),
            'noticia_id' => $id,
            'comentario' => $request->comentario,
        ]);

        $comentario->load('user');

        return response()->json([
            'comentario' => $comentario,
            'user_name' => $comentario->user->name ?? 'Usuario',
            'created_at' => $comentario->created_at->format('d/m/Y H:i'),
            'total' => \App\Models\NoticiaComentario::where('noticia_id', $id)->count()
        ]);
    }
}
