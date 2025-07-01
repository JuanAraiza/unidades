<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    //
    protected $fillable=[
        'dependencia',
        'deshabilitado'
    ];

    protected $table = 'dependencia';
}
