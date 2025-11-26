<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class archivos_gas extends Model
{
    //
    protected $fillable=[
        'tramite',
        'archivo',
        'fecha',
        'tipo'
    ];

    protected $table = 'archivos_gas';
}
