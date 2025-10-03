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
        if (auth()->check()) {
        //
        $tipovs = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('tipov.index', compact('tipovs'));
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
        
        return view('tipov.create');
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
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $tipov)
    {
        if (auth()->check()) {
        //
        $tipovs = Tipov::find($tipov);
       // return($tipovs);
        return view('tipov.show', compact('tipovs'));
         }else{
             return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $tipov)
    {
        if (auth()->check()) {
        //
         $tipovs = Tipov::find($tipov);
        return view('tipov.edit', compact('tipovs'));
         }else{
             return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $tipov)
    {
        if (auth()->check()) {
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
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $tipov)
    {
        if (auth()->check()) {
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
          }else{
             return redirect()->route('login');
        }
       
    }
}
