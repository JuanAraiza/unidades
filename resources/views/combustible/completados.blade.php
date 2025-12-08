@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Tramites Completos para Pago</h1>
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





 






<table id="tablaformailzados"  class="display table">
    <thead>
        <tr>
            <th>No. Folio</th>
            <th>No. Fiscal</th>
            <th>No.Tramite</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Dependencia</th>
            <th>Monto a<br>Afectar</th>
            <th>Folios</th>
            <th>Expediente<br>Completo</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach ($completados as $completado)
            <tr>
                <td>{{ $completado->folio }}</td>
                <td>{{ $completado->folio_fiscal  }}</td>
                <td>{{ $completado->tramite  }}</td>
                <td>{{ substr($completado->fecha,0,10)  }}</td>
               @php
                                  $gasolineria = \DB::table('proveedor')->find($completado->proveedor);
                              @endphp
                <td>{{ $gasolineria->gasolinera }}</td>
                @php
                    $dependencia = \DB::table('dependencia')->find($completado->dependencia);
                @endphp
                <td>{{ $dependencia->dependencia }}</td>
                <td>{{ $completado->importea_afectar  }}</td>

                <td>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalVerFactu{{ $completado->id }}">
 VER FOLIOS
</button>

<!-- Modal -->
<div class="modal fade" id="modalVerFactu{{ $completado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Folios Tramite: {{ $completado->tramite }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body row">
       

@php
                        $vls = explode(",", $completado->folios);
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



      </div>
     
      
    </div>
  </div>
</div>



                </td>
              <td>
  <a href="{{ route('combustible.descargarWord', $completado->id) }}" target="_blank" class="btn bg-blue"><i class="fa-solid fa-file-word"></i></a>
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



 


  
      </script>


@stop

@push('js')
   
    
@endpush