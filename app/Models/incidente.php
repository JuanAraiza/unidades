<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class incidente extends Model
{
    //
    protected $table = 'incidentes';
    protected $fillable = [
        'fecha_reg',
        'unidad',
        'descripcion_c',
        'descripcion',
        'importancia',
        'imagen',
        'id_user',
        'fecha_ven',
        'odometro',
        'estatus',
    ];
}
