@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Formalizados</h1>
@stop

@section('content')

<x-adminlte-card theme="primary" theme-mode="outline">

<div class="row col-md-12 ">
    <div class="col-md-4">    
        <a href="{{ route('combustible.index') }}" class="btn btn-primary btn-block">Solicitados</a>
    </div>
     <div class="col-md-4">    
        <a href="{{ route('combustible.validados') }}" class="btn btn-info btn-block">Aceptados</a>
    </div>
     <div class="col-md-4">    
        <a href="{{ route('combustible.cancelados') }}" class="btn btn-danger btn-block">Cancelados</a>
    </div>
     
</div>
<div class="row col-md-12 ">&nbsp; </div>
<div class="row col-md-12 ">
  <div class="col-md-4">    
        <a href="{{ route('combustible.comprometidos') }}" class="btn btn-success btn-block">Comprometidos</a>
    </div>
    <div class="col-md-4">    
        <a href="{{ route('combustible.formalizado') }}" class="btn bg-purple btn-block">Formalizado</a>
    </div>
     <div class="col-md-4">    
        <a href="{{ route('combustible.completados') }}" class="btn btn-warning btn-block">Tramite Completado para Pago</a>
    </div>
     
</div>

</x-adminlte-card>
<div class="col-md-12 row" >
&nbsp;
</div>
<?php /*
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
*/ ?>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>


<x-adminlte-card theme="primary" theme-mode="outline">

<table id="tablaformailzados"  class="display">
    <thead>
        <tr>
            <th>Factura</th>
            <th>No. Tramite</th>
            <th>Fecha</th>
            <th>Gasolinera</th>
            <th>Dependencia</th>
            <th>Folios</th>
            <th>Costo</th>
            <th>Factura</th>
            <th>Factura XML</th>
            <th>Excel</th>
            <th>Expediente Completo</th>
            <th>Carátula</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($formalizados as $formalizado)
            <tr>
                <td>
                <!-- Button trigger modal -->
<button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#modalVerFolios{{ $formalizado->id }}">
 <i class="fa-solid fa-pen-to-square"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalVerFolios{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Factura Tramite: {{ $formalizado->tramite }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body row">
      
      <form action="{{ route('combustible.changeFactura', $formalizado->id ) }}" enctype="multipart/form-data" class="col-md-12" method="post">
             @csrf
             @method('PUT')
        <div class="row col-md-12">
            <div class="col-md-12"> 
                <div class="form-group">
            <input type="text" name="factura" id="factura" value="{{ $formalizado->factura }}" class="form-control">
                </div>
            </div>
            <div class="col-md-12"> 
                <div class="form-group">
                    <input type="submit" class="btn bg-maroon form-control" value="Actualizar">
                </div>
            </div>

        </div>
        </form>
      

      </div>
      <div class="modal-footer">
       
      </div>

      
    </div>
  </div>
</div>
    <br>
                {{ $formalizado->factura }}</td>
                <td>{{ $formalizado->tramite }}</td>
                <td>{{ substr($formalizado->fecha,0,10) }}</td>
                <td>
                     @foreach($proveedores as $proveedor)
                        {{ $formalizado->gasolinera == $proveedor->id ? $proveedor->gasolinera : '' }}
                    @endforeach
                </td>
                
                <td> 
                    @foreach($dependencias as $dependencia)
                        {{ $formalizado->dependencia == $dependencia->id ? $dependencia->dependencia : '' }}
                    @endforeach
                </td>
                <td>
<!--  // Folios. -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalVerFactu{{ $formalizado->id }}">
FOLIOS
</button>

<!-- Modal -->
<div class="modal fade" id="modalVerFactu{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Folios Tramite: {{ $formalizado->tramite }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body row">
 @php
                        $vls = explode(",", $formalizado->folios);
                        $vales = \DB::table('combustibles')->whereIn('id', $vls)->get();
                    @endphp

                   
      <!--    tabla folios. -->
              <table class="table" style="font-size:10px;">
                  <thead>
                      <tr>
                        <th></th>
                          <th>DEPENDENCIA</th>
                          <th>FECHA</th>
                          <th>NO. ECONOMICO</th>
                          <th>COMBUSTIBLE</th>
                          <th>FOLIO</th>
                          <th>USO</th>
                          <th>LITROS</th>
                          <th>CHOFER</th>
                          <th>KILOMETRAJE</th>
                          <th>DESTINO</th>
                          <th>AREA ASIGNADA</th>
                          <th>GASOLINERA</th>
                          <th>COSTO</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($vales as $vale)
                          <tr>
                            <td>
                            @foreach($unidades as $unidad)
                                        <img style=" height:80px; "  src="{{ $vale->unidad == $unidad->id ? Storage::url($unidad->imagen) : '' }}" alt="">
                                    @endforeach  
                            
                            </td>
                              @php
                                  $dependencia = \DB::table('dependencia')->find($vale->dependencia);
                              @endphp
                              <td>{{ $dependencia->dependencia }}</td>
                              <td>{{ $vale->fecha }}</td>
                              @php
                                  $unidad = \DB::table('unidad')->find($vale->unidad);
                              @endphp
                              <td>{{ $unidad->no_economico }}</td>
                              @php
                                  switch ($vale->tipo_com) {
                                      case 1:
                                          $combust='GAS 1';
                                          break;
                                      case 2:
                                          $combust='GAS 2';
                                          break;
                                      case 3:
                                          $combust='DIESEL';
                                          break;
                                      case 4:
                                          $combust='GAS LP';
                                          break;
                                      default:
                                          $combust='';
                                  }
                              @endphp
                              <td>{{ $combust }}</td>
                              <td>{{ $vale->folio }}</td>
                              <td>{{ $vale->justificacion }}</td>
                              <td>{{ $vale->litros }}</td>
                              @php
                                  $chofer = \DB::table('operador')->find($vale->operador);
                              @endphp
                              <td>{{ $chofer->nombre }} {{ $chofer->paterno }} {{ $chofer->materno }}</td>
                              <td>{{ $vale->km }}</td>
                              <td>{{ $vale->destino }}</td>
                              @php
                                  $area = \DB::table('area')->find($vale->area);
                              @endphp
                              <td>{{ $area->area }}</td>
                              @php
                                  $gasolineria = \DB::table('proveedor')->find($vale->proveedor);
                              @endphp
                              <td>{{ $gasolineria->gasolinera }}</td>
                              <td>{{ $vale->costo }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>

                               
      <!--   fin tabla folios. -->
      </div>
      <div class="modal-footer">
       
      </div>

      
    </div>
  </div>
</div>


<!--  // Fin Folios. -->
                </td>
                <td>
                  <a href="{{ route('combustible.actualizarFolios', $formalizado->id) }}"  class="btn bg-blue "><i class="fa-solid fa-arrows-rotate"></i></a><br>
                    @php
                        $vls = explode(",", $formalizado->folios);
                        $costots = \DB::table('combustibles')->selectRaw('SUM(costo) as costo')->whereIn('id', $vls)->get();
                    @endphp


                    @foreach ($costots as $costot)
                        $ {{ number_format($costot->costo,2) }}
                    @endforeach
                </td>

          <!--   Archivo Factura -->      
<td style="text-align:center;">
<!-- Button trigger modal -->
 @php
                        $archivosfacs = \DB::table('archivos_gas')->where('tramite', $formalizado->id )->where('tipo', 1 )->first();
                    @endphp

                    @if(isset($archivosfacs->archivo))
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupFac{{ $formalizado->id }}">
                    @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalupFac{{ $formalizado->id }}">
                    @endif

 <i class="fa-solid fa-upload"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalupFac{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Facrtura Tramite: <strong>{{ $formalizado->tramite }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">

      
        

    <div class="col-md-12 row">
        <div class="col-md-12">
                   @if(isset($archivosfacs->archivo))
                       <a href="{{ Storage::url($archivosfacs->archivo) }}" target="_blank" class="btn btn-info btn-lg btn-block">Ver Factura</a>
                    @endif
          
        </div>
    </div>


<hr style="width: 100%;">
      <form action="{{ route('combustible.addFacturaCom', $formalizado->id ) }}" enctype="multipart/form-data" class="col-md-12" method="post">
             @csrf
        <div class="row col-md-12">
            <input name="tramite" type="hidden" value="{{ $formalizado->id }}"/>
            <input name="tipo" type="hidden" value="1"/>
            <div class="col-md-12"> 
                <div class="form-group">
            <input type="file" name="factura" id="factura" class="form-control">
                </div>
            </div>
            <div class="col-md-12"> 
                <div class="form-group">
                    <input type="submit" class="btn btn-success form-control" value="Subir Archivo">
                </div>
            </div>

        </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</td>

 <!--   Archivo XML -->      
<td style="text-align:center;">
<!-- Button trigger modal -->
 @php
                        $archivosfacs = \DB::table('archivos_gas')->where('tramite', $formalizado->id )->where('tipo', 2 )->first();
                    @endphp

                    @if(isset($archivosfacs->archivo))
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupXml{{ $formalizado->id }}">
                    @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalupXml{{ $formalizado->id }}">
                    @endif

 <i class="fa-solid fa-upload"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalupXml{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">XML Tramite: <strong>{{ $formalizado->tramite }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">

      
        

    <div class="col-md-12 row">
        <div class="col-md-12">
                   @if(isset($archivosfacs->archivo))
                       <a href="{{ Storage::url($archivosfacs->archivo) }}" target="_blank" class="btn btn-info btn-lg btn-block">Ver XML</a>
                    @endif
            
        </div>
    </div>


<hr style="width: 100%;">
      <form action="{{ route('combustible.addFacturaCom', $formalizado->id ) }}" enctype="multipart/form-data" class="col-md-12" method="post">
             @csrf
        <div class="row col-md-12">
            <input name="tramite" type="hidden" value="{{ $formalizado->id }}"/>
            <input name="tipo" type="hidden" value="2"/>
            <div class="col-md-12"> 
                <div class="form-group">
            <input type="file" name="factura" id="factura" class="form-control">
                </div>
            </div>
            <div class="col-md-12"> 
                <div class="form-group">
                    <input type="submit" class="btn btn-success form-control" value="Subir Archivo">
                </div>
            </div>

        </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</td>
<!-- tabla excel -->
<td>
<a href="{{ route('combustible.exportFoliosExcel', $formalizado->id) }}" target="_blank" class="btn btn-info ">Excel</a>
</td>
<!--   Archivo Expediente Completo -->      
<td style="text-align:center;">
<!-- Button trigger modal -->
 @php
                        $archivosfacs = \DB::table('archivos_gas')->where('tramite', $formalizado->id )->where('tipo', 3 )->first();
                    @endphp

                    @if(isset($archivosfacs->archivo))
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupExpC{{ $formalizado->id }}">
                    @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalupExpC{{ $formalizado->id }}">
                    @endif

 <i class="fa-solid fa-upload"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalupExpC{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Expediente Comp. Tramite: <strong>{{ $formalizado->tramite }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">

      
        

    <div class="col-md-12 row">
        <div class="col-md-12">
                   @if(isset($archivosfacs->archivo))
                       <a href="{{ Storage::url($archivosfacs->archivo) }}" target="_blank" class="btn btn-info  ">Ver Expediente</a>
                    @endif
          
        </div>
    </div>


<hr style="width: 100%;">
      <form action="{{ route('combustible.addFacturaCom', $formalizado->id ) }}" enctype="multipart/form-data" class="col-md-12" method="post">
             @csrf
        <div class="row col-md-12">
            <input name="tramite" type="hidden" value="{{ $formalizado->id }}"/>
            <input name="tipo" type="hidden" value="3"/>
            <div class="col-md-12"> 
                <div class="form-group">
            <input type="file" name="factura" id="factura" class="form-control">
                </div>
            </div>
            <div class="col-md-12"> 
                <div class="form-group">
                    <input type="submit" class="btn btn-success form-control" value="Subir Archivo">
                </div>
            </div>

        </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</td>

<!--   Archivo  Caratula -->      
<td style="text-align:center;">
<!-- Button trigger modal -->
 @php
                        $archivosfacs = \DB::table('archivos_gas')->where('tramite', $formalizado->id )->where('tipo', 4 )->first();
                    @endphp

                    @if(isset($archivosfacs->archivo))
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupCara{{ $formalizado->id }}">
                    @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalupCara{{ $formalizado->id }}">
                    @endif

 <i class="fa-solid fa-upload"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalupCara{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carátula Tramite: <strong>{{ $formalizado->tramite }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">

      
        

    <div class="col-md-12 row">
        <div class="col-md-12">
                   @if(isset($archivosfacs->archivo))
                       <a href="{{ Storage::url($archivosfacs->archivo) }}" target="_blank" class="btn btn-info  ">Ver Carátula</a>
                    @endif
          
        </div>
    </div>


<hr style="width: 100%;">
      <form action="{{ route('combustible.addFacturaCom', $formalizado->id ) }}" enctype="multipart/form-data" class="col-md-12" method="post">
             @csrf
        <div class="row col-md-12">
            <input name="tramite" type="hidden" value="{{ $formalizado->id }}"/>
            <input name="tipo" type="hidden" value="4"/>
            <div class="col-md-12"> 
                <div class="form-group">
            <input type="file" name="factura" id="factura" class="form-control">
                </div>
            </div>
            <div class="col-md-12"> 
                <div class="form-group">
                    <input type="submit" class="btn btn-success form-control" value="Subir Archivo">
                </div>
            </div>

        </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</td>

<td>
  <a href="{{ route('combustible.descargarWord', $formalizado->id) }}" target="_blank" class="btn bg-blue"><i class="fa-solid fa-file-word"></i></a>
</td> 

<!-- tabla eliminar -->
  <td><form class="delete-form" action="{{ route('combustible.destroyFactura', $formalizado->id) }}" method="post">
                @csrf
                @method('DELETE')
               
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
            </tr>
                @endforeach
          </tbody>
</table>



</x-adminlte-card>





   <!-- <p>Welcome to this beautiful admin panel. bla bla</p>-->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
     <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', (e) =>{
                e.preventDefault();
                Swal.fire({
                    title: "¿Estas Seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Si, Eliminar!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script>

var table = $('#tablaformailzados').DataTable({
    
         "scrollCollapse": true,
     order: [[ 2, 'desc' ]],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        
     
      
    });
    //********Esta bendita linea hace la magia, adjusta el header de la tabla con el body 
    table.columns.adjust();



var table2 = $('#tablavalesfol').DataTable({
         "scrollCollapse": true,
          order: [[ 2, 'desc' ]],
    });
    //********Esta bendita linea hace la magia, adjusta el header de la tabla con el body 
    table2.columns.adjust();
  
      </script>


@stop

@push('js')
   
    
@endpush