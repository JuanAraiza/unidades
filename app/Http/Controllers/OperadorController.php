<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Operador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
         $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
         $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        return view('operador.index', compact('operadores','areas','dependencias'));
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
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
         return view('operador.create', compact('areas','dependencias'));
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

        if($request->hasFile('fotos')){



    $extension = $request->fotos->extension();
    $nameFile = $request['nombre'].date('YmdHsi').'-IMG.'.$extension;

$upload = $request->file('fotos');
        $image = image::read($upload)
                ->scale(width:800)
                ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
        Storage ::put('operadores/'.$nameFile,
        $image
);


$request['foto']='operadores/'.$nameFile;
 //return "Imagen Subida";
}


if($request->hasFile('licencias')){

$extension = $request->licencias->extension();
$nameFile = $request['nombre'].date('YmdHsi').'-Licencia.'.$extension;
$request['licencia'] = Storage::putFileAs('licencias', $request->licencias, $nameFile);

}

$request['area'] = $request['area_id'];

        Operador::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Operador Creado!',
            'text' => 'Creado Correctamente'
        ]);
       return redirect()->route('operador.index');

       }else{
             return redirect()->route('login');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $operador)
    {
        if (auth()->check()) {
         $operadores = Operador::find($operador);
       // return($tipovs);
        return view('operador.show', compact('operadores'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $operador)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
         $operadores = Operador::find($operador);
        return view('operador.edit', compact('operadores','areas','dependencias'));
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
        $request->validate([
            'nombre' => 'required'
        ]);
        $operador = Operador::find($id);




$request['imagen']=$operador->foto;
$request['factura']=$operador->licencia;
if($request->hasFile('fotos')){
if($operador->foto){
    Storage::delete($operador->foto);
}

    $extension = $request->fotos->extension();
    $nameFile = $request['nombre'].date('YmdHsi').'-IMG.'.$extension;

$upload = $request->file('fotos');
        $image = Image::read($upload)
                ->scale(width:800)
                ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
        Storage ::put('operadores/'.$nameFile,
        $image
);
$request['foto']='operadores/'.$nameFile;
}


if($request->hasFile('licencias')){
if($operador->licencia){
    Storage::delete($operador->licencia);
}
$extension = $request->licencias->extension();
$nameFile = $request['nombre'].date('YmdHsi').'-Licencia.'.$extension;
$request['licencia'] = Storage::putFileAs('licencias', $request->facturas, $nameFile);

}
$request['area']=$request['area_id'];



        $operador->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Operador Actualizado!',
            'text' => 'Actualizado Correctamente'
        ]);
        return redirect()->route('operador.index');
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
        $operador = Operador::find($id);
        $operador->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Operador Eliminado!',
            'text' => 'Eliminado Correctamente'
        ]);
        return redirect()->route('operador.index');
        }else{
             return redirect()->route('login');
        }
        
    }
}
