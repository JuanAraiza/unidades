<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Responsable;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

class ResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
         $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('responsable.index', compact('responsables','areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        
         return view('responsable.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        Responsable::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Responsable Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('responsable.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $responsable)
    {
         $responsables = Responsable::find($responsable);
       // return($tipovs);
        return view('responsable.show', compact('responsables'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $responsable)
    {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::find($responsable);
        return view('responsable.edit', compact('responsables','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $responsable)
    {
         //
        $request->validate([
            'nombre' => 'required'
        ]);
        $responesables = Responsable::find($responsable);
        $responesables->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Responsable Modificado!',
            'text' => 'Modificada Correctamente'
        ]);
       return redirect()->route('responsable.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $responsable)
    {
        $responsables = Responsable::find($responsable);
        $responsables->update($request->all());
         //$areas->delete();
       // return($tipovs);
       session()->flash('swal', [
            'icon' => 'success',
            'title' =>'Responsable Eliminiado!',
            'text' => 'Eliminada Correctamente'
        ]);
         return redirect()->route('responsable.index');
    }
}
