<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    protected $table = 'operador';

    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'puesto',
        'area',
        'licencia',
        'vigencia',
        'foto',
        'deshabilitado'
    ];

  
}
