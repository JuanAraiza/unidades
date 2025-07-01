<?php

namespace App\Http\Controllers;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('dependencia.index', compact('dependencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('dependencia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'dependencia' => 'required'
        ]);
        Dependencia::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Dependencia Creada!',
            'text' => 'Creada Correctamente'
        ]);
       return redirect()->route('dependencia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $dependencia)
    {
        //
         $dependencias = Dependencia::find($dependencia);
       // return($tipovs);
        return view('dependencia.show', compact('dependencias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $dependencia)
    {
        //
        $dependencias = Dependencia::find($dependencia);
        return view('dependencia.edit', compact('dependencias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $dependencia)
    {
        //
        $request->validate([
            'dependencia' => 'required'
        ]);
        $dependencias = Dependencia::find($dependencia);
        $dependencias->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Dependenica Modificada!',
            'text' => 'Modificada Correctamente'
        ]);
       return redirect()->route('dependencia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $dependencia)
    {
        //
        $dependencias = Dependencia::find($dependencia);
        $dependencias->update($request->all());
         
         //$dependencias->delete();
       // return($tipovs);
       session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Dependencia Eliminiada!',
            'text' => 'Eliminada Correctamente'
        ]);
         return redirect()->route('dependencia.index');
    }
}
