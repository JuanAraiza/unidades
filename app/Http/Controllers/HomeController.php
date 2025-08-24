<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $disponibles = DB::table('unidad')
            ->where('deshabilitado',0)
            ->where('estatus',1)
            ->select(DB::raw('count(id) as cuenta'))
            ->groupBy('estatus')
            ->orderBy('estatus')
            ->get();
        $asignados = DB::table('unidad')
            ->where('deshabilitado',0)
            ->where('estatus',2)
            ->select(DB::raw('count(id) as cuenta'))
            ->groupBy('estatus')
            ->orderBy('estatus')
            ->get();

        $entallers = DB::table('unidad')
            ->where('deshabilitado',0)
            ->where('estatus',3)
            ->select(DB::raw('count(id) as cuenta'))
            ->groupBy('estatus')
            ->orderBy('estatus')
            ->get();
        $fueras = DB::table('unidad')
            ->where('deshabilitado',0)
            ->where('estatus',4)
            ->select(DB::raw('count(id) as cuenta'))
            ->groupBy('estatus')
            ->orderBy('estatus')
            ->get();

        $incidentes = DB::table('incidentes')
            ->join('unidad', 'incidentes.unidad', '=', 'unidad.id')
            ->select('unidad.id', 'unidad.modelo','unidad.marca', 'incidentes.descripcion_c')
            ->where('incidentes.estatus',1)
            ->get();

        $date=date('Y-m-d',strtotime(date('Y-m-d')."+ 10 days"));

        $seguros = DB::table('unidad')
            ->where('deshabilitado',0)
            ->where('vigencia', '<=', $date)
            ->get();

        //return($seguros);
        return view('home', compact('asignados','entallers','disponibles','fueras','incidentes','seguros'));
    }
}
