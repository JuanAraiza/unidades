<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estatus_unidad extends Model
{
    //
    protected $table = 'estatus_unidads';
    protected $fillable = [
        'unidad',
        'f_registro',
        'periodo',
        'estatus',
        'motivo',
    ];
}
