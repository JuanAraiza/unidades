<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //

     protected $fillable=[
        'area',
        'deshabilitado',
        'dependencia_id'
    ];

    protected $table = 'area';
}
