<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = [
        'user_id',
        'antetitulo',
        'titulo',
        'subtitulo',
        'entradilla',
        'cuerpo',
        'imagen',
        'pie_foto',
        'fecha_publicacion',
        'categoria',
        'estado',
        'likes_count',
    ];

    public function likes()
    {
        return $this->hasMany(NoticiaLike::class);
    }

    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function comentarios()
    {
        return $this->hasMany(NoticiaComentario::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
