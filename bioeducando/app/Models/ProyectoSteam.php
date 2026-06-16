<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoSteam extends Model
{
    protected $fillable = [
        'titulo',
        'categoria',
        'descripcion',
        'objetivos',
        'materiales',
        'impacto_ambiental',
        'imagen',
        'estado',
        'destacado',
        'user_id'
    ];

    /**
     * Relación con el usuario que propuso el proyecto
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
