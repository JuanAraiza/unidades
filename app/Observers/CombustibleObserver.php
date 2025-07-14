<?php

namespace App\Observers;

use App\Models\combustible;

class CombustibleObserver
{
    //
    public function created(combustible $combustible){
     $folios=$combustible->folio . str_pad($combustible->id, 5, "0", STR_PAD_LEFT);
        $combustible->folio=$folios;
        $combustible->saveQuietly();
    }
}
