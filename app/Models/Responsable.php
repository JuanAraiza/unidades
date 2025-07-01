<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $fillable=[
        'nombre',
        'paterno',
        'materno',
        'area_id',
        'puesto',
        'deshabilitado'
    ];

    protected $table = 'responsable';
}
