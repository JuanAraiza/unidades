<?php

namespace App\Http\Controllers;

use App\Models\PregcioGas;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class PreciogasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
         $precios = PregcioGas::latest('id')->paginate();
         $proveedores = Proveedor::latest('id')->paginate();
        return view('preciogas.index', compact('proveedores','precios'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
        //
         $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('preciogas.create', compact('proveedores'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->check()) {
        //
        $request->validate([
            'gas1' => 'required',
            'gas2' => 'required',
            'diesel' => 'required',
            'lp' => 'required',
            
        ]);
        if(isset($request['fecha']) and $request['fecha']!=''){

        }else{
            $request['fecha'] = date('Y-m-d');
        }
       
        $request['hora'] = date('H:i:s');
        PregcioGas::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Precio de Gas Guardado!',
            'text' => 'Guardao Correctamente'
        ]);
        return redirect()->route('preciogas.index');
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
        if (auth()->check()) {
        //
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->paginate();
        $precios = PregcioGas::find($id);
        return view('preciogas.edit', compact('proveedores','precios'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->check()) {
        //
         //
        $request->validate([
            'gas1' => 'required',
            'gas2' => 'required',
            'diesel' => 'required',
            'lp' => 'required',
            
        ]);
     
         $precios = PregcioGas::find($id);
        $precios->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Precio de Gas Actualizado!',
            'text' => 'Actualizado Correctamente'
        ]);
        return redirect()->route('preciogas.index');
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
