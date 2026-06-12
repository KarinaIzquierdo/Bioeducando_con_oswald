<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoSteam extends Model
{
    protected $fillable = ['titulo', 'categoria', 'descripcion', 'imagen'];
}
