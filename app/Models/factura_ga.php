<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class factura_ga extends Model
{
    //
    protected $table = 'factura_gas';
    protected $fillable = [
        'factura',
        'gasolinera',
        'proveedor',
        'folios',
        'otros',
        'fecha',
        'id_user',
        'dependencia',
        'oficio',
        'tramite',
        'combustible',
        'deshabilitado',
        'listo',
        'oculto',
        'folios2'
    ];
}
