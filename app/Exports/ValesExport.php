<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ValesExport implements FromView
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;

    }
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        $factura = DB::table('factura_gas')->find($this->id);
        $vls = explode(",", $factura->folios);
     
        return view('exports.vales', [
            'vales' => DB::table('combustibles')->whereIn('id', $vls)->get()
        ]);
    }

}
