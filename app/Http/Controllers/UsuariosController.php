<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (auth()->check()) {
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        $usuarios = Usuarios::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('usuarios.index', compact('dependencias','usuarios'));
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
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('usuarios.create', compact('dependencias'));
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
        $request['password']=Hash::make($request['password']);
        Usuarios::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('usuarios.index');
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
        ->latest('id')->paginate();
        $usuarios = Usuarios::find($id);
        return view('usuarios.edit', compact('usuarios','dependencias'));
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

            if($request['password']!=''){
                $request['password']=Hash::make($request['password']);
            }else{
                $request['password']=$request['passwordold'];
            }

             //return($request);
         $usuarios = Usuarios::find($id);
        $usuarios->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Actualizado!',
            'text' => 'Actualizado Correctamente'
        ]);
   
       return redirect()->route('usuarios.index');
       }else{
             return redirect()->route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
         if (auth()->check()) {
        //
        $usuarios = Usuarios::find($id);
        $usuarios->update($request->all());
         
         //$dependencias->delete();
       // return($tipovs);
       session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Eliminiado!',
            'text' => 'Eliminado Correctamente'
        ]);
         return redirect()->route('usuarios.index');
         }else{
             return redirect()->route('login');
        }
    }
}
