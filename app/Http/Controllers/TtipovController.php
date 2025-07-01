<?php

namespace App\Http\Controllers;

use App\Models\Tipov;
use Illuminate\Http\Request;

class TtipovController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tipovs = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('tipov.index', compact('tipovs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('tipov.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'tipo' => 'required'
        ]);
        Tipov::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Tipo de Vehículo Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('tipov.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $tipov)
    {
        //
        $tipovs = Tipov::find($tipov);
       // return($tipovs);
        return view('tipov.show', compact('tipovs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $tipov)
    {
        //
         $tipovs = Tipov::find($tipov);
        return view('tipov.edit', compact('tipovs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $tipov)
    {
        //
        $request->validate([
            'tipo' => 'required'
        ]);
        $tipov = Tipov::find($tipov);
        $tipov->update($request->all());
         session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Tipo de Vehículo Modificado!',
            'text' => 'Modificado Correctamente'
        ]);
       return redirect()->route('tipov.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $tipov)
    {
        //
         $tipovs = Tipov::find($tipov);
         $tipovs->update($request->all());
         //$tipovs->delete();
       // return($tipovs);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Tipo de Vehículo Eliminiado!',
            'text' => 'Eliminado Correctamente'
        ]);
         return redirect()->route('tipov.index');
       
    }
}
