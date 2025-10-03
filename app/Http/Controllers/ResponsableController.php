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
        if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
         $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('responsable.index', compact('responsables','areas'));
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
        
          $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        
         return view('responsable.create', compact('areas'));
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
       }else{
             return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $responsable)
    {
        if (auth()->check()) {
         $responsables = Responsable::find($responsable);
       // return($tipovs);
        return view('responsable.show', compact('responsables'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $responsable)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::find($responsable);
        return view('responsable.edit', compact('responsables','areas'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $responsable)
    {
        if (auth()->check()) {
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
       }else{
             return redirect()->route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $responsable)
    {
        if (auth()->check()) {
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
         }else{
             return redirect()->route('login');
        }
    }
}
