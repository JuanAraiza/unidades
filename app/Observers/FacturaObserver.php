<?php

namespace App\Observers;

use App\Models\factura_ga;

class FacturaObserver
{
    /**
     * Handle the factura_gas "created" event.
     */
    public function created(factura_ga $factura_gas): void
    {
        //
        
        $folios=$factura_gas->folio . str_pad($factura_gas->id, 5, "0", STR_PAD_LEFT);
        $factura_gas->folio=$folios;
        $factura_gas->saveQuietly();
    }

}
