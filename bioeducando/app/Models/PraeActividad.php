<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraeActividad extends Model
{
    protected $table = 'prae_actividads';
    protected $fillable = ['titulo', 'descripcion', 'fecha', 'estado'];
}
