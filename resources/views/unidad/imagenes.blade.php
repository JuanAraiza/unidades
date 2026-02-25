@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Imágenes Unidad</h1>
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

<x-adminlte-card  class="col-lg-12" title="IMAGENES" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

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
<form action="{{ route('unidad.guardarimagen', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf




    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  

    <div class="col-md-8"> 
        <div class="form-group">
            <label>Fotografia / Imagen</label>
            @if(isset($inci))
            <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($inci->imagen) }}" alt="">
            @endif
            <input type="file" name="foto"  class="form-control">
        </div>
    </div>

<div class="col-md-4"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Imagen
                </button>
        </div>
    </div>


</div>



</form>
@php
} 
@endphp
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($imagenes as $imagen)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $imagen->id }}" class="{{ $loop->first ? 'active' : '' }}"></li>
 @endforeach 
  </ol>
  <div class="carousel-inner">
     @foreach ($imagenes as $imagen)
    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img class="d-block w-100" src="{{ Storage::url($imagen->imagen) }}" >
    </div>
     @endforeach
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</x-adminlte-card>




</div>





<x-adminlte-card theme="primary" theme-mode="outline">
<div class="row col-md-12 mb-2">

 @foreach ($imagenes as $imagen)

    <div class="col-md-3"> 
        <div class="form-group" style="text-align: center;">
           <a type="button" class="btn" data-toggle="modal" data-target="#imgModal{{ $imagen->id }}">
   <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded"  src="{{ Storage::url($imagen->imagen) }}" alt="">
</a>
           
        <br><br>
            <form class="delete-form" action="{{ route('imagenesu.destroyImagen', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="imagen" value="{{ $imagen->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>    
        
        </div>
    </div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="imgModal{{ $imagen->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded"  src="{{ Storage::url($imagen->imagen) }}" alt="">
      </div>
     
    </div>
  </div>
</div>



 @endforeach
</div>




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