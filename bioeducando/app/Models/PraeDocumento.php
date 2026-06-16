<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraeDocumento extends Model
{
    protected $table = 'prae_documentos';
    protected $fillable = ['titulo', 'archivo_path'];
}
