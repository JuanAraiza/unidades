<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\combustible;
use App\Models\Operador;
use App\Models\Operador_Unidad;
use App\Models\Proveedor;
use App\Models\Responsable;
use App\Models\Tipov;
use App\Models\Unidad;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('estatus', 1)
        ->where('deshabilitado', 0)
        ->latest('id')->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       
        //return($operadores_u);
      
        return view('combustible.index', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
        }else{
             return redirect()->route('login');
        }
    
    }

    public function validados()
    {
         if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('estatus', 2)
        ->where('deshabilitado', 0)
        ->latest('id')->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       //return('hhh');
        //return($operadores_u);
      
        return view('combustible.validados', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
     }else{
             return redirect()->route('login');
        }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('id', $id)
        ->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       
        //return($vales);
      
        return view('combustible.show', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
     public function validar(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->vigencia = $request->vigencia;
        $vale->proveedor = $request->proveedor;
        $vale->estatus = 2;
        $vale->validado = 1;
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Validado!',
            'text' => 'Validado Correctamente'
        ]);


       return redirect()->route('combustible.validados');

       }else{
             return redirect()->route('login');
        }
    }

    public function cancelar(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->deshabilitado = 1;
        $vale->mensaje_c = $request->mensajec;
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cancelado!',
            'text' => 'Vale Cancelado Correctamente'
        ]);


       return redirect()->route('combustible.index');

       }else{
             return redirect()->route('login');
        }

    }

    public function cancelarValidados(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->deshabilitado = 1;
        $vale->mensaje_c = $request->mensajec;
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cancelado!',
            'text' => 'Vale Cancelado Correctamente'
        ]);


       return redirect()->route('combustible.validados');

       }else{
             return redirect()->route('login');
        }


    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


public function imvale(string $vale)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        
         $vales = combustible::find($vale);
        $unidades = Unidad::find($vales->unidad);
       // return($tipovs);
       
       $customPaper = array(0,0,567.00,283.80);
       $pdf = Pdf::loadView('combustible.imvale', compact('unidades','areas','responsables','tipos','operadores','vales'))->setPaper($customPaper, 'landscape');
       return $pdf->stream('vale.pdf');
        //return view('unidad.imvale', compact('unidades','areas','responsables','tipos','operadores','vales'));
    }else{
             return redirect()->route('login');
        }
    
    }

}
