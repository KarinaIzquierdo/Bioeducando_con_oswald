<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reto extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'categoria',
        'dificultad',
        'puntos',
        'duracion',
        'evidencias',
        'insignia'
    ];

    protected $casts = [
        'evidencias' => 'array'
    ];
}
