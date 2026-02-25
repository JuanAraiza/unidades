<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\presupuestoc as ModelsPresupuestoc;
use Illuminate\Http\Request;

class PresupuestoC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (auth()->check()) {
        //
        $presupuestos = ModelsPresupuestoc::get();
         $dependencias = Dependencia::where('deshabilitado',0)
        ->get();
         
        return view('presupuestoc.index', compact('presupuestos','dependencias'));
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
       if (auth()->check()) {
        //
        $dependencias = Dependencia::where('deshabilitado',0)
        ->get();
        
         return view('presupuestoc.create', compact('dependencias'));
         }else{
             return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        if (auth()->check()) {
        $request->validate([
            'ejercicio' => 'required',
            'fondo' => 'required',
            'programa' => 'required',
            'centro_g' => 'required',
            'dependencia' => 'required',
            'area_fun' => 'required',
            'asignado' => 'required',
            'disponible' => 'required'
        ]);
        $dependencias = Dependencia::where('id',$request->input('dependencia'))
        ->get();
        $request['partida'] = 2610;
        $request['partida_den'] = 'COMBUSTIBLES, LUBRICANTES Y ADITIVOS';
        $request['nombre_cg'] = $dependencias[0]->dependencia;

        $request['asignado']=str_replace(',', '', $request['asignado']);  
        $request['asignado']=str_replace(' ', '', $request['asignado']);
        $request['asignado']=str_replace('$', '', $request['asignado']); 
        $request['asignado']=floatval($request['asignado']);

        $request['disponible']=str_replace(',', '', $request['disponible']);  
        $request['disponible']=str_replace(' ', '', $request['disponible']);
        $request['disponible']=str_replace('$', '', $request['disponible']); 
        $request['disponible']=floatval($request['disponible']);

        //return($request);

        ModelsPresupuestoc::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Registro Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('presupuestoc.index');
       }else{
             return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if (auth()->check()) {
        //
        $dependencias = Dependencia::where('deshabilitado',0)
        ->get();
        $presupuestos = ModelsPresupuestoc::find($id);
         return view('presupuestoc.edit', compact('dependencias','presupuestos'));
         }else{
             return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if (auth()->check()) {
        $request->validate([
            'ejercicio' => 'required',
            'fondo' => 'required',
            'programa' => 'required',
            'centro_g' => 'required',
            'dependencia' => 'required',
            'area_fun' => 'required',
            'asignado' => 'required',
            'disponible' => 'required'
        ]);
        $presupuestos = ModelsPresupuestoc::find($id);
        $dependencias = Dependencia::where('id',$request->input('dependencia'))
        ->get();
        $request['partida'] = 2610;
        $request['partida_den'] = 'COMBUSTIBLES, LUBRICANTES Y ADITIVOS';
        $request['nombre_cg'] = $dependencias[0]->dependencia;

        $request['asignado']=str_replace(',', '', $request['asignado']);  
        $request['asignado']=str_replace(' ', '', $request['asignado']);
        $request['asignado']=str_replace('$', '', $request['asignado']); 
        $request['asignado']=floatval($request['asignado']);

        $request['disponible']=str_replace(',', '', $request['disponible']);  
        $request['disponible']=str_replace(' ', '', $request['disponible']);
        $request['disponible']=str_replace('$', '', $request['disponible']); 
        $request['disponible']=floatval($request['disponible']);

        //return($request);

        $presupuestos->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Registro Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('presupuestoc.index');
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
}
