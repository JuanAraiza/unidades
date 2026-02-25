<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = 'proveedor';
    protected $fillable = [
        'gasolinera',
        'rfc',
        'razon_social',         
        'nomenclatura',
        'contra',
        'deshabilitado',
    ];

}
