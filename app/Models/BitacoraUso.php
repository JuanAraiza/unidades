<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitacoraUso extends Model
{
    //
    protected $table = 'bitacora_usos';

    protected $fillable = [
        'unidad',
        'fecha_reg',
        'actividad',
        'evidencia1',
        'evidencia2',
        'evidencia3',
        'dependencia',
        'fecha',
        'operador',
        'id_user',
        'destino',
        'km'


    ];

}
