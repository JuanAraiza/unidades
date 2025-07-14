<?php

namespace App\Models;

use App\Observers\CombustibleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
#[ObservedBy(CombustibleObserver::class)]
class combustible extends Model
{
    //
    protected $fillable = [
        'folio',
        'fecha',
        'hora',
        'unidad',
        'km',
        'justificacion',
        'operador',
        'destino',
        'tipo_com',
        'litros',  
        'costo',
        'area',
        'dependencia',
        'proveedor',
        'validado',
        'estatus',
        'mensaje_c',
        'deshabilitado',
        'fecha_c',
        'fecha_p'
        
    ];

    protected $table = 'combustibles';
}
