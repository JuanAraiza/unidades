<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docu_unidad extends Model
{
    //
    protected $table = 'docu_unidads';
    protected $fillable = [
        'unidad',
        'documento',
        'titulo',
        'vencimiento',
    ];
}
