<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoPrae extends Model
{
    protected $fillable = ['titulo', 'institucion', 'descripcion', 'imagen', 'archivo_pdf'];
}
