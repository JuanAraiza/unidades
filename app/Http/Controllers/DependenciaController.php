<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if (auth()->check()) {
        //
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('dependencia.index', compact('dependencias','areas'));
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
         return view('dependencia.create');
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
            'dependencia' => 'required'
        ]);
        Dependencia::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Dependencia Creada!',
            'text' => 'Creada Correctamente'
        ]);
       return redirect()->route('dependencia.index');
       }else{
             return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $dependencia)
    {
         if (auth()->check()) {
        //
         $dependencias = Dependencia::find($dependencia);
       // return($tipovs);
        return view('dependencia.show', compact('dependencias'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $dependencia)
    {
         if (auth()->check()) {
        //
        $dependencias = Dependencia::find($dependencia);
        return view('dependencia.edit', compact('dependencias'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $dependencia)
    {
         if (auth()->check()) {
        //
        $request->validate([
            'dependencia' => 'required'
        ]);
        $dependencias = Dependencia::find($dependencia);
        $dependencias->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Dependencia Modificada!',
            'text' => 'Modificada Correctamente'
        ]);
       return redirect()->route('dependencia.index');
       }else{
             return redirect()->route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $dependencia)
    {
         if (auth()->check()) {
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
         }else{
             return redirect()->route('login');
        }
    }


     public function addArea(Request $request)
        {
            if (auth()->check()) {
             $request->validate([
            'area' => 'required'
                ]);
                Area::create($request->all());
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => 'Area Creada!',
                    'text' => 'Creada Correctamente'
                ]);

           return redirect()->route('dependencia.index');
            }else{
             return redirect()->route('login');
        }
        }


        public function destroyArea(Request $request)
    {
       
         if (auth()->check()) {
                //
                $area = $request->area_id;
                $areas = Area::find($area);
                $areas->update($request->all());
                
                //$dependencias->delete();
                // return($tipovs);
                session()->flash('swal', [
                        'icon' => 'success',
                        'title' => 'Area Eliminiada!',
                        'text' => 'Eliminada Correctamente'
                    ]);
         return redirect()->route('dependencia.index');
         }else{
             return redirect()->route('login');
        }
    }
}
