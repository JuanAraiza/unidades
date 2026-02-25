<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class presupuestoc extends Model
{
    //
    protected $table = 'presupuestocs';
    protected $fillable = [
        'ejercicio',
        'fondo',
        'programa',
        'centro_g',
        'nombre_cg',
        'dependencia',
        'area_fun',
        'partida',
        'partida_den',
        'asignado',
        'disponible',
        'comprometido',
        'formalizado',
        'tramite',
        'dependencia',
    ];
}
