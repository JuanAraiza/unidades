<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Docu_unidad;
use App\Models\Operador;
use App\Models\Unidad;
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
         if (auth()->check()) {
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
            ->select('unidad.id', 'unidad.modelo','unidad.marca','unidad.no_economico','unidad.dependencia', 'incidentes.descripcion_c')
            ->where('incidentes.estatus',1)
            ->get();

        $date=date('Y-m-d',strtotime(date('Y-m-d')."+ 10 days"));

        /*$seguros = DB::table('unidad')
            ->where('deshabilitado',0)
            ->where('vigencia', '<=', $date)
            ->get();
*/
        $dependencias = Dependencia::where('deshabilitado',0)
            ->get();
            $areas = Area::where('deshabilitado',0)
            ->get();

            //SELECT max(fecha), unidad, tipo FROM `docu_unidads` group by unidad,tipo; 

        $seguros = Docu_unidad::select('unidad','tipo')
         ->selectRaw('MAX(fecha) as fecha')
         ->groupBy('unidad','tipo')
         ->get();
        
         foreach ($seguros as $doctipo) {

            $doctipo->dias= Docu_unidad::select('tipo','fecha')
            ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
            ->where('tipo', $doctipo->tipo)
            ->where('unidad', $doctipo->unidad)
            ->orderBy('fecha', 'DESC')
            ->first()->dias;

            $doctipo->vigencia= Docu_unidad::select('tipo','fecha','vencimiento')
            ->where('tipo', $doctipo->tipo)
            ->where('unidad', $doctipo->unidad)
            ->orderBy('fecha', 'DESC')
            ->first()->vencimiento;

            $unid= Unidad::where('id', $doctipo->unidad)
            ->first();
//return($unid);
            $doctipo->area=$unid->area;
            $doctipo->modelo=$unid->modelo;
            $doctipo->marca=$unid->marca;
            $doctipo->placas=$unid->placas;
            $doctipo->no_economico=$unid->no_economico;
            
          




         }

         $licenciasvencidasdias = Operador::select('id','nombre','paterno','materno', 'vigencia')
            ->where('deshabilitado',0)
            ->selectRaw('DATEDIFF (vigencia, DATE(NOW())) as dias')
            ->get();


            //return $licenciasvencidasdias;
         //$docus=
         //return($seguros);


/*
        $vrefrendos = Docu_unidad::select('tipo','fecha')
         ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
         ->where('tipo', 1)
         ->orderBy('fecha', 'DESC')
         ->first();


         $vrevistas = Docu_unidad::select('tipo','fecha')
         ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
         ->where('tipo', 2)
         ->orderBy('fecha', 'DESC')
         ->first();

         $vpolizas = Docu_unidad::select('tipo','fecha')
         ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
         ->where('tipo', 3)
         ->orderBy('fecha', 'DESC')
         ->first();

         $vplacas = Docu_unidad::select('tipo','fecha')
         ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
         ->where('tipo', 4)
         ->orderBy('fecha', 'DESC')
         ->first();

         $valtas = Docu_unidad::select('tipo','fecha')
         ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
         ->where('tipo', 5)
         ->orderBy('fecha', 'DESC')
         ->first();

         $vfacturas = Docu_unidad::select('tipo','fecha')
         ->selectRaw('DATEDIFF (vencimiento, DATE(NOW())) as dias')
         ->where('tipo', 6)
         ->orderBy('fecha', 'DESC')
         ->first();
*/

        //return($dependencias);
        return view('home', compact('asignados','entallers','disponibles','fueras','incidentes','seguros','dependencias','areas','licenciasvencidasdias'));
        }else{
             return redirect()->route('login');
        }
    }
}
