<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaComentario extends Model
{
    protected $fillable = ['user_id', 'noticia_id', 'comentario'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }
}
