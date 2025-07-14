<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PregcioGas extends Model
{
    //
    protected $table = 'pregcio_gas';
    protected $fillable = [
        'gas1',
        'gas2',
        'diesel',
        'lp',
        'fecha',
        'hora',
        'proveedor'
    ];


}
