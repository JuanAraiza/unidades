<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\ValesExport;
use App\Models\archivos_gas;
use App\Models\Area;
use App\Models\combustible;
use App\Models\Dependencia;
use App\Models\factura_ga;
use App\Models\Operador;
use App\Models\Operador_Unidad;
use App\Models\PregcioGas;
use App\Models\Proveedor;
use App\Models\Responsable;
use App\Models\Tipov;
use App\Models\Unidad;
use Barryvdh\DomPDF\Facade\Pdf;
use DragonCode\Support\Helpers\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('estatus', 1)
        ->where('deshabilitado', 0)
        ->orderBy('id', 'DESC')
        ->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       
        //return($operadores_u);
      
        return view('combustible.index', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
        }else{
             return redirect()->route('login');
        }
    
    }

    public function validados()
    {
         if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('estatus', 2)
        ->where('deshabilitado', 0)
        ->orderBy('fecha', 'DESC')
        ->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       //return('hhh');
        //return($operadores_u);
      
        return view('combustible.validados', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
     }else{
             return redirect()->route('login');
        }
    
    }

    public function cancelados()
    {
         if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('deshabilitado', 1)
        ->orderBy('id', 'DESC')
        ->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       //return('hhh');
        //return($operadores_u);
      
        return view('combustible.cancelados', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
     }else{
             return redirect()->route('login');
        }
    
    }

    public function comprometidos()
    {
         if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->get();
        $vales = combustible::where('estatus', 3)
        ->where('deshabilitado', 0)
        ->orderBy('id', 'DESC')
        ->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       //return('hhh');
        //return($operadores_u);
      
        return view('combustible.comprometidos', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores','dependencias'));
     }else{
             return redirect()->route('login');
        }
    
    }


     public function formalizado()
    {
         if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->get();
        $formalizados = factura_ga::orderBy('id', 'DESC')
        ->where('oficio',0)
        ->get();
        
        return view('combustible.formalizado', compact('areas','proveedores','dependencias','formalizados'));
     }else{
             return redirect()->route('login');
        }
    
    }


     public function completados()
    {
         if (auth()->check()) {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $dependencias = Dependencia::where('deshabilitado',0)
        ->get();
        $formalizados = factura_ga::orderBy('id', 'DESC')
        ->where('oficio',0)
        ->get();
        
        return view('combustible.completados', compact('areas','proveedores','dependencias','formalizados'));
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::where('id', $id)
        ->get();
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       
        //return($vales);
      
        return view('combustible.show', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
    }


     public function cargarvale(string $id)
    {
        //
        $areas = Area::where('deshabilitado',0)
        ->latest('id')->get();
        $proveedores = Proveedor::where('deshabilitado',0)
        ->latest('id')->get();
        $responsables = Responsable::where('deshabilitado',0)
        ->latest('id')->get();
        $tipos = Tipov::where('deshabilitado',0)
        ->latest('id')->get();
        $unidades = Unidad::where('deshabilitado',0)
        ->latest('id')->get();
        $vales = combustible::find($id);
        $operadores_u = Operador_Unidad::latest('id')->get();
        $operadores = Operador::latest('id')->get();
       
        //return($vales);
      
        return view('combustible.cargarvale', compact('unidades','areas','responsables','tipos','operadores','vales','operadores_u','proveedores'));
    }


  public function actualizarFolios(string $id,Request $request)
    {
        if (auth()->check()) {

                $factura = factura_ga::find($id);
                $vls = explode(",", $factura->folios);
                $vales = DB::table('combustibles')
                    ->whereIn('id', $vls)
                    ->get();

                foreach($vales as $vale){

                    // Actualizar Costos

                    $valec = combustible::find($vale->id);
                    $precigas = PregcioGas::where('proveedor', $valec->proveedor)
                    ->where('fecha',$valec->fecha_c)
                    ->orderBy('id', 'DESC')
                    ->first();

                    switch ($valec->tipo_com) {
                        case 1:
                            if(isset($precigas->gas1)){
                            $valec->precio_unitario = $precigas->gas1;
                            }else{
                                $valec->precio_unitario = 0;
                            } 
                            break;
                        case 2:
                            if(isset($precigas->gas2)){
                            $valec->precio_unitario = $precigas->gas2;
                            }else{
                                $valec->precio_unitario = 0;
                            } 
                            break;
                        case 3:
                            if(isset($precigas->diesel)){
                            $valec->precio_unitario = $precigas->diesel;
                            }else{
                                $valec->precio_unitario = 0;
                            } 
                            break;
                        case 4:
                            if(isset($precigas->lp)){
                            $valec->precio_unitario = $precigas->lp;
                            }else{
                                $valec->precio_unitario = 0;
                            } 
                            break;
                        default:
                            $valec->precio_unitario = 0;
                    }

                    $costototal = $valec->litros * $valec->precio_unitario;
                    $valec->costo = $costototal;
                    $valec->save();

                    // Fin Actualizar Costos

                       
                        /*$arch = archivos_gas::find($archivo->id);
                        $arch->delete();*/
                }

                //return($vales);
        return redirect()->route('combustible.formalizado');
        }else{
            return redirect()->route('login');
        }

    }


     public function cargarvaledos(string $id,Request $request)
    {
        //

        //return $request;
        if($request['litros']<=$request['olitros']){
        $vales = combustible::find($id);
        $precigas = PregcioGas::where('proveedor', $vales->proveedor)
        ->where('fecha',date('Y-m-d'))
        ->orderBy('id', 'DESC')
        ->first();

        switch ($vales->tipo_com) {
            case 1:
                if(isset($precigas->gas1)){
                $vales->precio_unitario = $precigas->gas1;
                }else{
                    $vales->precio_unitario = 0;
                } 
                break;
            case 2:
                if(isset($precigas->gas2)){
                $vales->precio_unitario = $precigas->gas2;
                }else{
                    $vales->precio_unitario = 0;
                } 
                break;
            case 3:
                if(isset($precigas->diesel)){
                $vales->precio_unitario = $precigas->diesel;
                }else{
                    $vales->precio_unitario = 0;
                } 
                break;
            case 4:
                if(isset($precigas->lp)){
                $vales->precio_unitario = $precigas->lp;
                }else{
                    $vales->precio_unitario = 0;
                } 
                break;
            default:
                $vales->precio_unitario = 0;
        }

        $costototal = $vales->litros * $vales->precio_unitario;
        $vales->costo = $costototal;
        $vales->estatus=3;
        $vales->fecha_c=date('Y-m-d');
        $vales->folio_sat=$request['folio_sat'];
        
        $vales->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cargado!',
            'text' => 'Cargado Correctamente'
        ]);

       
    }else{
$msn='Litros deben ser menos o igual a: '.$request['olitros'].' Litros';

         session()->flash('swal', [
            
            'title' => 'Error en Litros!',
            'text' => $msn
        ]);
    }
       
        //return($vales);
       return redirect()->route('combustible.cargarvale', ['vale' => $id]);

        
    }



     public function crearFactura(Request $request)
    {
        //
     
    if (auth()->check()) {

        if($request['folios2']!=''){
            if(isset($request['fproveedor']) and $request['fproveedor']!=''){
                $proveedores = Proveedor::where('gasolinera',$request['fproveedor'])->first();
                $request['gasolinera']=$proveedores->gasolinera;
                $request['gasolinera']=$proveedores->id;
            }else{
                session()->flash('swal', [
            'icon' => 'search',
            'title' => 'Falta Seleccionar Proveedor en los filtros de busqueda!',
            'text' => ''
        ]);
        //return($request);
        return redirect()->route('combustible.comprometidos');
            }
        $user = auth()->user();
        $request['id_user']=$user->id;
        $request['fecha'] = date('Y-m-d H:i:s');
        $request['combustible'] = $request['ftipogas'];

            if(isset($request['fdependencia']) and $request['fdependencia']!=''){
                $dependencias = Dependencia::where('dependencia',$request['fdependencia'])->first();
                $dep=$dependencias->id;

            }else{
             
        session()->flash('swal', [
            'icon' => 'search',
            'title' => 'Falta Seleccionar Dependencia en los filtros de busqueda!',
            'text' => ''
        ]);
        //return($request);
        return redirect()->route('combustible.comprometidos');

            }
        $request['dependencia']=$dep;
        $gas='AD';
        $maxfactura = factura_ga::selectRaw('MAX(id) as id')
        ->first();
        
        if(isset($maxfactura->id) and $maxfactura->id >= 1){

            //return($maxfactura);
            $fc=$maxfactura->id;
        }else{
            $fc=0;
        }
        
        $fc++;



          
        $no_tramite=date('dmY').$gas.str_pad($dep, 2, "0", STR_PAD_LEFT).str_pad($fc, 6, "0", STR_PAD_LEFT);
        $request['tramite'] = $no_tramite;

       // return($request);
        factura_ga::create($request->all());
        
        $vls = explode(",", $request['folios']);
            DB::table('combustibles')
            ->whereIn('id', $vls)
            ->update(['estatus'=> 4]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Factura Registrada!',
            'text' => 'Registro Correctamente'
        ]);
        //return($request);
        return redirect()->route('combustible.formalizado');

    }else{
        session()->flash('swal', [
            'icon' => 'search',
            'title' => 'Falta Seleccionar Folios!',
            'text' => ''
        ]);
        //return($request);
        return redirect()->route('combustible.comprometidos');
    }

         }else{
             return redirect()->route('login');
        }
    
    }


    public function addFacturaCom(Request $request, string $id){
    if (auth()->check()) {

        //return($request);

        if($request->hasFile('factura')){

            $combustible = combustible::find($id);
            $facgas = archivos_gas::where('tramite',$request['tramite'])
            ->where('tipo',$request['tipo'])
            ->get();
            //return($combustible);
            if(isset($facgas->archivo) and $facgas->archivo){
                Storage::delete($facgas->archivo);
                $facgas->delete();
            }

            $extension = $request->factura->extension();
            $nameFile = $request['factura'].date('YmdHsi').'-FACC.'.$extension;
            $request['archivo'] = Storage::putFileAs('facturasc', $request->factura, $nameFile);
            $request['fecha'] = date('Y-m-d H:i:s');

            //$combustible->update($request->all());
        //
        //return($request);
            archivos_gas::create($request->all());
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Factura Cargada!',
                'text' => 'Cargada Correctamente'
            ]);
        
        
        // return($tipovs);
            return redirect()->route('combustible.formalizado');

            }else{

                session()->flash('swal', [
                'icon' => '',
                'title' => 'Falta Archivo!',
                'text' => ''
                ]);
        
        
        // return($tipovs);
            return redirect()->route('combustible.formalizado');

            }
       
   
       
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
       }else{
             return redirect()->route('login');
        }
        
    }

    public function changeFactura(Request $request, string $id){
    if (auth()->check()) {

        //return($request);

            $facgas = factura_ga::find($id);
          
            $facgas->update($request->all());
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'No. Factura Actualizada!',
                'text' => 'Actualizada Correctamente'
            ]);
        
        
        // return($tipovs);
            return redirect()->route('combustible.formalizado');

          
       // return view('unidad.incidente', compact('unidades','tipos','incidentes','usuarios'));
       }else{
             return redirect()->route('login');
        }
        
    }

    public function exportFoliosExcel(string $id)
        {
             if (auth()->check()) {

           return Excel::download(new ValesExport($id), 'vales'.date('YmdHis').'.xlsx');
           }else{
             return redirect()->route('login');
            }
        }


         public function descargarWord(string $id)
        {
           if (auth()->check()) {
           // return(public_path());
         $archwod = public_path().'/formato_combustible.docx';
           $template = new \PhpOffice\PhpWord\TemplateProcessor($archwod);


           $template->setValue('no_fiscal','123');

           $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
           $template->saveAs($tempFile);

           $headers =[
                "Content-Type: application/octet-stream",
           ];
           //return($tempFile);
           return response()->download($tempFile, 'Formato-Gas.docx')->deleteFileAfterSend(true);

           }else{
             return redirect()->route('login');
             }
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


       public function destroyFactura(Request $request, string $id)
    {
        //
        if (auth()->check()) {
        //
        $factura = factura_ga::find($id);

        $vls = explode(",", $factura->folios);
            DB::table('combustibles')
            ->whereIn('id', $vls)
            ->update(['estatus'=> 3]);

        $archivos = DB::table('archivos_gas')
                    ->where('tramite', $id)
                    ->get();

       foreach($archivos as $archivo){
            storage::delete($archivo->archivo); 
            $arch = archivos_gas::find($archivo->id);
            $arch->delete();
       }
        //$archivos->each->delete();
        $factura->delete();


        session()->flash('swal', [
            'icon' => 'Eliminada',
            'title' => 'Factura Eliminada!',
            'text' => 'Eliminada Correctamente'
        ]);

        return redirect()->route('combustible.formalizado');
        }else{
             return redirect()->route('login');
        }
    }


    public function cargados(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->proveedor = $request->proveedor;


        $vale->estatus = 3;
        
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Validado!',
            'text' => 'Validado Correctamente'
        ]);


       return redirect()->route('combustible.validados');

       }else{
             return redirect()->route('login');
        }
    }


     public function validar(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->vigencia = $request->vigencia;
        $vale->proveedor = $request->proveedor;
        $vale->estatus = 2;
        $vale->validado = 1;
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Validado!',
            'text' => 'Validado Correctamente'
        ]);


       return redirect()->route('combustible.validados');

       }else{
             return redirect()->route('login');
        }
    }

    public function cancelar(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->deshabilitado = 1;
        $vale->mensaje_c = $request->mensajec;
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cancelado!',
            'text' => 'Vale Cancelado Correctamente'
        ]);


       return redirect()->route('combustible.index');

       }else{
             return redirect()->route('login');
        }

    }

    public function cancelarValidados(Request $request, string $id)
    {
        if (auth()->check()) {
        //
        $vale = combustible::find($id);
        $vale->deshabilitado = 1;
        $vale->mensaje_c = $request->mensajec;
       // return($vale);
        $vale->save();

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cancelado!',
            'text' => 'Vale Cancelado Correctamente'
        ]);


       return redirect()->route('combustible.validados');

       }else{
             return redirect()->route('login');
        }


    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
       $pdf = Pdf::loadView('combustible.imvale', compact('unidades','areas','responsables','tipos','operadores','vales'))->setPaper($customPaper, 'landscape');
       return $pdf->stream('vale.pdf');
        //return view('unidad.imvale', compact('unidades','areas','responsables','tipos','operadores','vales'));
    }else{
             return redirect()->route('login');
        }
    
    }

}
