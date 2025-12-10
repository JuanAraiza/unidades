<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contacto_oper extends Model
{
    //
    protected $fillable = [
        'operador',
        'nombre',
        'telefono',
        'direccion',
        'parentesco',
        
        
    ];

    protected $table = 'contacto_opers';
}
