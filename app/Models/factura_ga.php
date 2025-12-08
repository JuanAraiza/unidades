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
        'folios2',
        'costo_t',
        'folio',
        'datos_g',
        'nom_partida',
        'no_partida',
        'presupuestado',
        'ejercido',
        'por_ejercer',
        'importea_afectar',
        'saldo_nuevo',
        'folio_fiscal'
    ];
}
