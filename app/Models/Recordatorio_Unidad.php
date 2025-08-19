<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recordatorio_Unidad extends Model
{
    //
    protected $table = 'recordatorio__unidads';
    protected $fillable = ['unidad', 'recordatorio', 'fecha','estatus']; 
}
