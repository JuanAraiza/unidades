<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Responsable;
use App\Models\Tipov;
use App\Models\Unidad;
use App\Observers\UnidadObserver;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        $unidades = Unidad::orderBy('id','desc')
            ->where('deshabilitado', 0)
            ->paginate();

        $areas = Area::all();
        $dependencias = Dependencia::all();
        return view('unidad.index', compact('unidades','dependencias','areas'));
        
       // return $unidades;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
      
         return view('unidad.create', compact('areas','responsables','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $folio='SF30-';
        $areas = Area::find($request['area_id']);
        $dependencia = Dependencia::find($areas->dependencia_id);
        $folio.=str_pad($dependencia->id, 2, "0", STR_PAD_LEFT).'-';
        $folio.=str_pad($request['area_id'], 2, "0", STR_PAD_LEFT).'-';

        switch($request['combustible']){
            case 'Gasolina':
                 switch($request['tunidad']){
                    case 'Vehiculos':
                        $folio.='V010-';
                    break;
                    case 'Maquinaria':
                        $folio.='V011-';
                    break;
                    case 'Herramientas':
                        $folio.='V012-';
                    break;
                    case 'Otros':
                        $folio.='V013-';
                    break;
                 }
                break;
            case 'Diesel':
                switch($request['tunidad']){
                    case 'Vehiculos':
                        $folio.='V020-';
                    break;
                    case 'Maquinaria':
                        $folio.='V021-';
                    break;
                    case 'Herramientas':
                        $folio.='V022-';
                    break;
                    case 'Otros':
                        $folio.='V023-';
                    break;
                 }
                break;
            case 'Gas LP':
                switch($request['tunidad']){
                    case 'Vehiculos':
                        $folio.='V030-';
                    break;
                    case 'Maquinaria':
                        $folio.='V031-';
                    break;
                    case 'Herramientas':
                        $folio.='V032-';
                    break;
                    case 'Otros':
                        $folio.='V033-';
                    break;
                 }
                break;
            
        }

/*
        $request['folio']=$folio;
       */
        $request['user']=auth()->user('web')->id;

  
if($request->hasFile('image')){



    $extension = $request->image->extension();
    $nameFile = $request['folio'].date('YmdHsi').'-IMG.'.$extension;
 /*$request['imagen'] = Storage::putFileAs('unidades', $request->image, $nameFile);

*/

$upload = $request->file('image');
        $image = Image::read($upload)
                ->scale(width:800)
                ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
        Storage ::put('unidades/'.$nameFile,
        $image
);
$request['area']=$request['area_id'];

$request['imagen']='unidades/'.$nameFile;
 //return "Imagen Subida";
}


if($request->hasFile('facturas')){

$extension = $request->facturas->extension();
$nameFile = $request['folio'].date('YmdHsi').'-Factura.'.$extension;
$request['factura'] = Storage::putFileAs('facturas', $request->facturas, $nameFile);

}

$request['clave']=md5($request['no_serie'].now());
$unidad = Unidad::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Unidad Registrada!',
            'text' => 'Creada Correctamente'
        ]);

return redirect()->route('unidad.show', $unidad);
       // return $request->all();

         
    }

    /**
     * Display the specified resource.
     */
    public function show(string $unidad)
    {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
         //
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.show', compact('unidades','areas','responsables','tipos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $unidad)
    {
        //
         $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
         //
        $unidades = Unidad::find($unidad);
        return view('unidad.edit', compact('unidades','tipos','responsables','areas'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $unidad)
    {
        
$unidades = Unidad::find($unidad);

$request['imagen']=$unidades->imagen;
$request['factura']=$unidades->factura;
if($request->hasFile('image')){
    $extension = $request->image->extension();
    $nameFile = $request['folio'].date('YmdHsi').'-IMG.'.$extension;

$upload = $request->file('image');
        $image = Image::read($upload)
                ->scale(width:800)
                ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
        Storage ::put('unidades/'.$nameFile,
        $image
);
$request['imagen']='unidades/'.$nameFile;
}


if($request->hasFile('facturas')){

$extension = $request->facturas->extension();
$nameFile = $request['folio'].date('YmdHsi').'-Factura.'.$extension;
$request['factura'] = Storage::putFileAs('facturas', $request->facturas, $nameFile);

}
$request['area']=$request['area_id'];

$unidades->update($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Datos Guardados!',
            'text' => 'Actalizado Correctamente'
        ]);

return redirect()->route('unidad.show', $unidad);
       // return $request->all();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
