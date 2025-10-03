<?php

namespace App\Http\Controllers;

use App\Models\PregcioGas;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
        //
         $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('proveedor.index', compact('proveedores'));
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
        return view('proveedor.create');
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
            'gasolinera' => 'required'
        ]);
        Proveedor::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Responsable Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('proveedor.index');
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
    public function edit(string $proveedor)
    {
        if (auth()->check()) {
        //
          $proveedores = Proveedor::find($proveedor);
       // return($tipovs);
        return view('proveedor.edit', compact('proveedores'));
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
        $request->validate([
            'gasolinera' => 'required'
        ]);
        $proveedor = Proveedor::find($id);
        $proveedor->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',  
            
            'title' => 'Proveedor Actualizado!',
            'text' => 'Actualizado Correctamente'
        ]);
        return redirect()->route('proveedor.index');
         }else{
             return redirect()->route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->check()) {
        //
        $proveedor = Proveedor::find($id);
        $proveedor->deshabilitado = 1;
        $proveedor->save();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Proveedor Eliminado!',
            'text' => 'Eliminado Correctamente'
        ]);
        return redirect()->route('proveedor.index');    
         }else{
             return redirect()->route('login');
        }
    }
}
