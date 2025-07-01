<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
         $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('area.index', compact('areas','dependencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        
         return view('area.create', compact('dependencias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required'
        ]);
        Area::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Area Creada!',
            'text' => 'Creada Correctamente'
        ]);
       return redirect()->route('area.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $area)
    {
        //
        $areas = Area::find($area);
       // return($tipovs);
        return view('area.show', compact('areas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $area)
    {
        //
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        $areas = Area::find($area);
        return view('area.edit', compact('areas','dependencias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $area)
    {
        //
        $request->validate([
            'area' => 'required'
        ]);
        $areas = Area::find($area);
        $areas->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Area Modificada!',
            'text' => 'Modificada Correctamente'
        ]);
       return redirect()->route('area.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $area)
    {
        $areas = Area::find($area);
        $areas->update($request->all());
         //$areas->delete();
       // return($tipovs);
       session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Area Eliminiada!',
            'text' => 'Eliminada Correctamente'
        ]);
         return redirect()->route('area.index');
    }
}
