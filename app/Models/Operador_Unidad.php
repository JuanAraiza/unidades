<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operador_Unidad extends Model
{
    //

    protected $table = 'operador__unidads';
    protected $fillable = ['unidad', 'operador'];
}
