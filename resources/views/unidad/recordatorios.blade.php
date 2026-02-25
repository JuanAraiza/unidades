@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>OPERADORES Unidad</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline">

<div class="row col-md-12 ">
    <div class="col-md-3">    
        <a href="{{ route('unidad.show', $unidades->id) }}" class="btn btn-primary btn-block">Ver Información</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.combustible', $unidades->id) }}" class="btn btn-default btn-block">Cargar Combustible</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.incidente', $unidades->id) }}" class="btn btn-info btn-block">Registro Incidentes</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.recordatorios', $unidades->id) }}" class="btn btn-success btn-block">Recordatorios</a>
    </div>
</div>
<div class="row col-md-12 ">&nbsp; </div>
<div class="row col-md-12 ">
    <div class="col-md-3">    
        <a href="{{ route('unidad.bitacora', $unidades->id) }}" class="btn bg-purple btn-block">Bitacora Usos</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.estatus', $unidades->id) }}" class="btn btn-warning btn-block">Estatus</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.documentos', $unidades->id) }}" class="btn btn-danger btn-block">Documentos</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.imagenes', $unidades->id) }}" class="btn bg-navy btn-block">Imagenes</a>
    </div>
</div>

</x-adminlte-card>




<div class="row col-md-12 ">

<x-adminlte-card  class="col-lg-8" title="RECORDATORIOS" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

<div class="row col-md-12 ">


   <div class="col-md-3"> 
        <div class="form-group">
            <label>Modelo de la unidad</label>
            <p>{{ $unidades->modelo }}</p>
        </div>
        
    </div>

  <div class="col-md-3"> 
       <div class="form-group">
            <label>Marca</label>
            <p>{{ $unidades->marca }}</p>
        </div>
    </div>

     <div class="col-md-3"> 
        <div class="form-group">
            <label>Color / Año</label>
            <p>{{ $unidades->color }} / {{ $unidades->anio }}</p>
        </div>
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Placas</label>
            <p>{{ $unidades->placas }}</p>
        </div>
    </div>




</div>

@php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarRecordatorio', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  
    <div class="col-md-12"> 
        <div class="form-group">
            <label>Recordatorio</label>
           <x-adminlte-textarea name="taBasic" placeholder="Recordatorio..." name="recordatorio" ></x-adminlte-textarea>
        </div>
    </div>
<div class="col-md-4"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Recordatorio
                </button>
        </div>
    </div>
</div>
</form>
@php
} 
@endphp
</x-adminlte-card>

<div class="row col-md-4 ">
    <div class="col-md-1 ">&nbsp;</div>
<x-adminlte-card  class="col-lg-11" title="IMAGEN" theme="success" style="padding-right: 0px; padding-left: 0px;" >
 <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($unidades->imagen) }}" alt="">

</x-adminlte-card>
</div>



</div>





<x-adminlte-card theme="primary" theme-mode="outline">

 <table id="tabladocumentos" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>Recordatorio</th>
                  <th>Fecha</th>
                  <th>Estatus</th>
                  <th>Cerrar</th>
                    <th>Eliminar</th>       
                </tr>
                </thead>
                <tbody>
               @foreach ($recordatorios as $recordatorio)
                <tr>
                    <td>{{ $recordatorio->recordatorio }}</td>
                    <td>{{ $recordatorio->fecha }}</td>
                    <td>
                        @switch($recordatorio->estatus)
                            @case(1)
                                <span class="badge badge-success">Abierto</span>
                                @break
                            @case(2)
                                <span class="badge badge-danger">Cerrado</span>
                                @break
                        @endswitch
</td>
 <td>
@if($recordatorio->estatus != 2)

      <form class="cerrar-form" action="{{ route('recordatorios.cerrarRecordatorio', $unidades->id) }}" method="post">
                @csrf
                @method('POST')
                <input type="hidden" name="id_recordatorio" value="{{ $recordatorio->id }}"  >
              <button class="btn bg-black">  <span class="fas fa-close"></span></button>
</form>  
@endif                 
</td>
     <td>
      <form class="delete-form" action="{{ route('recordatorios.distroyRecordatorio', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="recordatorioid" value="{{ $recordatorio->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
                
            </tr>
                @endforeach
                </tbody>
               
              </table>



</x-adminlte-card>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!");
    
    $('.carousel').carousel();
     </script>


      <script>


$('#tablaincidentes').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});
      </script>

@stop

@push('js')
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
@endpush