<?php

namespace App\Observers;

use App\Models\Unidad;

class UnidadObserver
{
    //
    
    public function created(Unidad $unidad){
/*
        $folios=$unidad->folio .'-'. str_pad($unidad->id, 5, "0", STR_PAD_LEFT);
        $unidad->folio=$folios;
        $unidad->saveQuietly();*/
       // $unidad->update($unidad->all());
    }
}
