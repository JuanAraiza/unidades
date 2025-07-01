<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipov extends Model
{
    
    protected $fillable=[
        'tipo',
        'deshabilitado'
    ];

    protected $table = 'tvehiculo';
    //
}
