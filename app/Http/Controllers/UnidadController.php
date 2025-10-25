<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\combustible;
use App\Models\Dependencia;
use App\Models\Docu_unidad;
use App\Models\Estatus_unidad;
use App\Models\img_unidad;
use App\Models\incidente;
use App\Models\Operador;
use App\Models\Operador_Unidad;
use App\Models\Recordatorio_Unidad;
use App\Models\Responsable;
use App\Models\Tipov;
use App\Models\Unidad;
use App\Models\Usuarios;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Container\Attributes\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {

        $unidades = Unidad::orderBy('id','desc')
            ->where('deshabilitado', 0)
            ->paginate();

        $areas = Area::all();
        $dependencias = Dependencia::all();
        return view('unidad.index', compact('unidades','dependencias','areas'));
        
       // return $unidades;
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
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();

         return view('unidad.create', compact('areas','responsables','tipos','dependencias','operadores'));
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

if($request->hasFile('polizas')){

$extension = $request->polizas->extension();
$nameFile = $request['folio'].date('YmdHsi').'-Poliza.'.$extension;
$request['poliza'] = Storage::putFileAs('Polizas', $request->polizas, $nameFile);

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
       }else{
             return redirect()->route('login');
        }

         
    }

    /**
     * Display the specified resource.
     */
    public function show(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
         //
         $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.show', compact('unidades','areas','responsables','tipos','dependencias','operadores'));
        }else{
             return redirect()->route('login');
        }
    }


     public function combustible(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        
         $vales = combustible::where('unidad', $unidad)
         ->where('deshabilitado', 0)->latest('id')->paginate();
        /*
        $operadores_u = Operador_Unidad::where('unidad', $unidad)
         ->latest('id')->paginate();
        $operadores = Operador::whereIn('id',$operadores_u->pluck('operador'))
        ->latest('id')->paginate();*/
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
       // return($tipovs);
       $unidades = Unidad::find($unidad);
        return view('unidad.combustible', compact('unidades','areas','responsables','tipos','operadores','vales'));
        }else{
             return redirect()->route('login');
        }
    }

     public function imvale(string $vale)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        
         $vales = combustible::find($vale);
        $unidades = Unidad::find($vales->unidad);
       // return($tipovs);
       
       $customPaper = array(0,0,567.00,283.80);
       $pdf = Pdf::loadView('unidad.imvale', compact('unidades','areas','responsables','tipos','operadores','vales'))->setPaper($customPaper, 'landscape');
       return $pdf->stream('vale.pdf');
        //return view('unidad.imvale', compact('unidades','areas','responsables','tipos','operadores','vales'));
        }else{
             return redirect()->route('login');
        }
    }

public function guardarvale(Request $request, string $unidad)
    {
if (auth()->check()) {

        $folio='SF30-';
        $areas = Area::find($request['area']);
        $dependencia = Dependencia::find($areas->dependencia_id);
        $request['dependencia']=$dependencia->id;
        $folio.=str_pad($dependencia->id, 2, "0", STR_PAD_LEFT).'-';
        $folio.=str_pad($request['area'], 2, "0", STR_PAD_LEFT).'-';

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

        $request['fecha']=date('Y-m-d');
        $request['hora']=date('H:i:s'); 

        $request['folio']=$folio;
       
         
        combustible::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Vale Registrado!',
            'text' => 'Registrado Correctamente'
        ]);
        /*$areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        */
         //
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        //return view('unidad.combustible', compact('unidades','areas','responsables','tipos','operadores'));
         return redirect()->route('unidad.combustible', $unidad);
         }else{
             return redirect()->route('login');
        }
    }


    
public function guardarinci(Request $request, string $unidad){
    if (auth()->check()) {
        if($request->hasFile('foto')){
            $extension = $request->foto->extension();
            $nameFile = $request['foto'].date('YmdHsi').'-INCI.'.$extension;
            $upload = $request->file('foto');
                    $image = Image::read($upload)
                            ->scale(width:800)
                            ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
                    Storage ::put('incidentes/'.$nameFile,
                    $image
            );
            $request['imagen']='incidentes/'.$nameFile;
        }
       
        $request['id_user']=auth()->user('web')->id;         

        incidente::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Incidente Registrado!',
            'text' => 'Registrado Correctamente'
        ]);
       
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $incidentes = incidente::where('unidad', $unidad)
         ->latest('id')->paginate();
         //
        $usuarios = Usuarios::All();

        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return redirect()->route('unidad.incidente', $unidad);
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
       }else{
             return redirect()->route('login');
        }
        
    }


 public function incidente(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $incidentes = incidente::where('unidad', $unidad)
         ->latest('id')->paginate();
        $graincidentes = DB::table('incidentes')
            ->where('unidad', $unidad)
            ->select(DB::raw('count(id) as cuenta'), DB::raw('concat(YEAR(fecha_reg),"-",MONTH(fecha_reg)) as fecha'))
            ->groupBy('fecha')
            ->get();

          

          $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);
       // return($graincidentes);
        return view('unidad.incidente', compact('unidades','areas','responsables','tipos','operadores','incidentes','usuarios','graincidentes'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $unidad)
    {
        if (auth()->check()) {
        //
         $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->paginate();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->latest('id')->paginate();
         //
         $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $unidades = Unidad::find($unidad);
        return view('unidad.edit', compact('unidades','tipos','responsables','areas','dependencias','operadores'));
        }else{
             return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $unidad)
    {
        if (auth()->check()) {
$unidades = Unidad::find($unidad);

$request['imagen']=$unidades->imagen;
$request['factura']=$unidades->factura;
if($request->hasFile('image')){
    if($unidades->imagen){
        Storage::delete($unidades->imagen);
    }
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
if($unidades->factura){
    Storage::delete($unidades->factura);
}
$extension = $request->facturas->extension();
$nameFile = $request['folio'].date('YmdHsi').'-Factura.'.$extension;
$request['factura'] = Storage::putFileAs('facturas', $request->facturas, $nameFile);

}
$request['area']=$request['area_id'];

if($request->hasFile('polizas')){
if($unidades->poliza){
    Storage::delete($unidades->poliza);
}
$extension = $request->polizas->extension();
$nameFile = $request['folio'].date('YmdHsi').'-Poliza.'.$extension;
$request['poliza'] = Storage::putFileAs('Polizas', $request->polizas, $nameFile);

}

$unidades->update($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Datos Guardados!',
            'text' => 'Actalizado Correctamente'
        ]);

return redirect()->route('unidad.show', $unidad);
}else{
             return redirect()->route('login');
        }
       // return $request->all();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->check()) {
        //
        $unidad = Unidad::find($id);
        $unidad->deshabilitado=1;
        $unidad->save();


        session()->flash('swal', [
            'icon' => 'Eliminado',
            'title' => 'Unidad Eliminada!',
            'text' => 'Eliminada Correctamente'
        ]);

        return redirect()->route('unidad.index');
        }else{
             return redirect()->route('login');
        }

    }

 public function updateIncidente(Request $request)
    {
        if (auth()->check()) {
        $unidad = $request['unidad'];
        $incidente = $request['id_incidente'];

        $inci = incidente::find($incidente);




        if($request->hasFile('foto')){
            if($inci->foto){
             Storage::delete($inci->foto);
                }
            $extension = $request->foto->extension();
            $nameFile = $request['foto'].date('YmdHsi').'-INCI.'.$extension;
            $upload = $request->file('foto');
                    $image = Image::read($upload)
                            ->scale(width:800)
                            ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
                    Storage ::put('incidentes/'.$nameFile,
                    $image
            );
            $request['imagen']='incidentes/'.$nameFile;
        }

        $inci->update($request->all());


        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => 'Incidente Actualizado!',
                    'text' => 'Actualizado Correctamente'
                ]);

    return redirect()->route('unidad.incidente', $unidad);
    }else{
             return redirect()->route('login');
        }
    
    }


      public function editIncidente(Request $request, string $unidad)
    {
        if (auth()->check()) {
        $unidad = $request['unidad'];
        $incidente = $request['incidente'];

        $inci = incidente::find($incidente);

         $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $incidentes = incidente::where('unidad', $unidad)
         ->latest('id')->paginate();
          $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);

        
        return view('unidad.incidente', compact('unidades','areas','responsables','tipos','operadores','incidentes','usuarios','inci'));
        }else{
             return redirect()->route('login');
        }
    }

     public function distroyIncidente(Request $request)
    {
        if (auth()->check()) {
        $unidad = $request['unidad'];
        $incidente = $request['incidente'];

$eincidentes = incidente::find($incidente);
if($eincidentes->imagen){
    Storage::delete($eincidentes->imagen);
}
        $eincidentes->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Incidente Eliminado!',
            'text' => 'Eliminado Correctamente'
        ]);

          return redirect()->route('unidad.incidente', $unidad);
          }else{
             return redirect()->route('login');
        }
    }


public function cerrarIncidente(Request $request, string $unidad)
    {
        if (auth()->check()) {
        $unidad = $request['unidad'];
        $incidente = $request['id_incidente'];
        $request['estatus']=4;
        $inci = incidente::find($incidente);
        $inci->update($request->all());

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => 'Incidente Cerrado!',
                    'text' => 'Cerrado Correctamente'
                ]);

    return redirect()->route('unidad.incidente', $unidad);
    }else{
             return redirect()->route('login');
        }
    
    }



// ////////////. Imagenes de Incidentes //////////////
 public function imagenes(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $imagenes = img_unidad::where('unidad', $unidad)
         ->latest('id')->paginate();
          $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.imagenes', compact('unidades','areas','responsables','tipos','operadores','imagenes','usuarios'));
        }else{
             return redirect()->route('login');
        }
    }


public function guardarimagenu(Request $request, string $unidad){
    if (auth()->check()) {
        if($request->hasFile('foto')){
            $extension = $request->foto->extension();
            $nameFile = $request['foto'].'gu'.date('YmdHsi').'-INCI.'.$extension;
            $upload = $request->file('foto');
                    $image = Image::read($upload)
                            ->scale(width:800)
                            ->encodeByExtension($upload->getClientOriginalExtension(), quality: 70);
                    Storage ::put('imagesUnidad/'.$nameFile,
                    $image
            );
            $request['imagen']='imagesUnidad/'.$nameFile;
        }
       
     
        img_unidad::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Imagen Guardada!',
            'text' => 'Agregada Correctamente'
        ]);
       
  
       // return($tipovs);
        return redirect()->route('unidad.imagenes', $unidad);
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
       }else{
             return redirect()->route('login');
        }
        
    }

 public function distroyImagen(Request $request, string $unidad)
    {
       if (auth()->check()) {
        $imagen = $request['imagen'];

$imagenes = img_unidad::find($imagen);
if($imagenes->imagen){
    Storage::delete($imagenes->imagen);
}
        $imagenes->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Imagen Eliminada!',
            'text' => 'Eliminada Correctamente'
        ]);

          return redirect()->route('unidad.imagenes', $unidad);
          }else{
             return redirect()->route('login');
        }
    }


// ////////////. Documentos Unidad  //////////////
 public function documentos(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $documentos = Docu_unidad::where('unidad', $unidad)
         ->latest('id')->paginate();
        $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.documentos', compact('unidades','areas','responsables','tipos','operadores','documentos','usuarios'));
        }else{
             return redirect()->route('login');
        }
    }


public function guardarDocumento(Request $request, string $unidad){
    if (auth()->check()) {
        if($request->hasFile('archivo')){
            
            $extension = $request->archivo->extension();
            $nameFile = $request['archivo'].date('YmdHsi').'-Docuu.'.$extension;
            $request['documento'] = Storage::putFileAs('documentosUnidad', $request->archivo, $nameFile);

        }
     
        Docu_unidad::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Documento Guardado!',
            'text' => 'Agregado Correctamente'
        ]);
       
  
       // return($tipovs);
        return redirect()->route('unidad.documentos', $unidad);
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
       }else{
             return redirect()->route('login');
        }
        
    }

 public function distroyDocumento(Request $request, string $unidad)
    {
       if (auth()->check()) {
        $documento = $request['documento'];

$documentos = Docu_unidad::find($documento);
if($documentos->documento){
    Storage::delete($documentos->documento);
}
        $documentos->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Documento Eliminado!',
            'text' => 'Eliminado Correctamente'
        ]);

          return redirect()->route('unidad.documentos', $unidad);
          }else{
             return redirect()->route('login');
        }
    }



    // ////////////. Estatus Unidad  //////////////
 public function estatus(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $estatus = Estatus_unidad::where('unidad', $unidad)
         ->latest('id')->paginate();
        $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.estatus', compact('unidades','areas','responsables','tipos','operadores','estatus','usuarios'));
        }else{
             return redirect()->route('login');
        }
    }

    public function guardarEstatus(Request $request, string $unidad){
        if (auth()->check()) {
        $unidads = Unidad::find($unidad);
        $unidads->estatus=$request['estatus'];
        $unidads->update(); 
     
        Estatus_unidad::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Estatus Guardado!',
            'text' => 'Agregado Correctamente'
        ]);
       
  
       // return($tipovs);
        return redirect()->route('unidad.estatus', $unidad);
        }else{
             return redirect()->route('login');
        }
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
        
    }

    public function distroyEstatus(Request $request, string $unidad)
        {
        if (auth()->check()) {
            $estatus = $request['estatusid'];

    $estatuss = Estatus_unidad::find($estatus);

            $estatuss->delete();
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Esatus Eliminado!',
                'text' => 'Eliminado Correctamente'
            ]);

            return redirect()->route('unidad.estatus', $unidad);
            }else{
             return redirect()->route('login');
        }
        }

// ////////////. Recordatoris Unidad  //////////////
 public function recordatorios(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $recordatorios = Recordatorio_Unidad::where('unidad', $unidad)
         ->latest('id')->paginate();
        $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.recordatorios', compact('unidades','areas','responsables','tipos','operadores','recordatorios','usuarios'));
        }else{
             return redirect()->route('login');
        }
    }

    public function guardarRecordatorio(Request $request, string $unidad){
        if (auth()->check()) {
     $request['fecha']=date('Y-m-d H:s:i');
        Recordatorio_Unidad::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Recordatorio Guardado!',
            'text' => 'Agregado Correctamente'
        ]);
       
  
       // return($tipovs);
        return redirect()->route('unidad.recordatorios', $unidad);
        }else{
             return redirect()->route('login');
        }
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
        
    }

public function cerrarRecordatorio(Request $request, string $unidad)
    {
        if (auth()->check()) {
        $recordatorio = $request['id_recordatorio'];
        $request['estatus']=2;
        $inci = Recordatorio_Unidad::find($recordatorio);
        $inci->update($request->all());

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => 'Recordatorio Cerrado!',
                    'text' => 'Cerrado Correctamente'
                ]);

    return redirect()->route('unidad.recordatorios', $unidad);
    }else{
             return redirect()->route('login');
        }
    
    }


    public function distroyRecordatorio(Request $request, string $unidad)
        {
        if (auth()->check()) {
            $recordatorio = $request['recordatorioid'];

    $recordatorios = Recordatorio_Unidad::find($recordatorio);

            $recordatorios->delete();
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Recordatorio Eliminado!',
                'text' => 'Eliminado Correctamente'
            ]);

            return redirect()->route('unidad.recordatorios', $unidad);
            }else{
             return redirect()->route('login');
        }
        }


        // ////////////. Operdaro Unidad  //////////////
 public function operadores(string $unidad)
    {
        if (auth()->check()) {
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->paginate();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->paginate();
        $tipos = Tipov::where('deshabilitado',0)
         ->latest('id')->paginate();
        $operadores = Operador::where('deshabilitado',0)
        ->latest('id')->paginate();
        $operadores_uni = Operador_Unidad::where('unidad', $unidad)
         ->latest('id')->paginate();
        $usuarios = Usuarios::All();
        $unidades = Unidad::find($unidad);
       // return($tipovs);
        return view('unidad.operadores', compact('unidades','areas','responsables','tipos','operadores','operadores_uni','usuarios'));
        }else{
             return redirect()->route('login');
        }
    }


public function guardarOperador(Request $request, string $unidad){
if (auth()->check()) {
        Operador_Unidad::create($request->all());
        //
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Operador Guardado!',
            'text' => 'Agregado Correctamente'
        ]);
       
  
       // return($tipovs);
        return redirect()->route('unidad.operadores', $unidad);
        }else{
             return redirect()->route('login');
        }
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
        
    }


     public function distroyOperador(Request $request, string $unidad)
        {
            if (auth()->check()) {
            $operador = $request['operadorid'];
            $operadors = Operador_Unidad::find($operador);

            $operadors->delete();
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Operador Eliminado!',
                'text' => 'Eliminado Correctamente'
            ]);

            return redirect()->route('unidad.operadores', $unidad);
            }else{
             return redirect()->route('login');
        }
        }

       

}



