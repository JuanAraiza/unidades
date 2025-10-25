<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Unidad extends Model
{
     protected $fillable=[
        'tunidad',
        'modelo',
        'marca',
        'anio',
        'color',
        'imagen',
        'placas',
        'no_economico',
        'combustible',
        'tipov',
        'estatus',
        'inicio_est',
        'medida_usu',
        'medida_con',
        'dependencia',
        'area',
        'responsable',
        'operador',
        'no_serie',
        'cilindros',
        'tipo_com',
        'factura',
        'uso',
        'detalles',
        'clave',
        'user',
        'deshabilitado',
        'poliza',
        'aseguradora',
        'vigencia'
        ];

    protected $table = 'unidad';
}
