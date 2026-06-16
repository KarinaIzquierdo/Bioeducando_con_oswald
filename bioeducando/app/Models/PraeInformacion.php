<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraeInformacion extends Model
{
    protected $table = 'prae_informacions';
    protected $fillable = ['descripcion', 'objetivos'];
}
