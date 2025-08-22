@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Estatus Unidad</h1>
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
        <a href="{{ route('unidad.operadores', $unidades->id) }}" class="btn bg-purple btn-block">Operadores</a>
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

<x-adminlte-card  class="col-lg-8" title="ESTATUS" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

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


<form action="{{ route('unidad.guardarEstatus', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf




    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-4"> 
        <div class="form-group">
            <label>Fecha de Registro</label>
            <input type="date" name="f_registro"   class="form-control">
        </div>
        @error('f_registro')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
    

<div class="col-md-4"> 
        <div class="form-group">
            <label>Periodo</label>
            <input type="text" name="periodo" value="{{ old('periodo') }}" class="form-control"
               placeholder="Periodo"  >
        </div>
        @error('periodo')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-4"> 
        <div class="form-group">
            <label>Estatus</label>
             {{-- Minimal --}}
            <x-adminlte-select2 name="estatus"  data-placeholder="Selecciona estatus....">
                        <option @selected(old('estatus')) value="1">Disponible</option>
                        <option @selected(old('estatus')) value="2">Asignado</option>
                        <option @selected(old('estatus')) value="3">En Taller</option>
                        <option @selected(old('estatus')) value="4">Fuera de Servicio</option>
            </x-adminlte-select2>
    </div>
</div>
    <div class="col-md-4"> 
        <div class="form-group">
            <label>Motivo</label>
            <input type="text" name="motivo" value="{{ old('motivo') }}" class="form-control"
               placeholder="Motivo"  >
        </div>
        @error('motivo')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

<div class="col-md-4"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Estatus
                </button>
        </div>
    </div>


</div>



</form>

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
                  <th>Fecha Registro</th>
                  <th>Periodo</th>
                  <th>Estatus</th>
                  <th>Motivo</th>
                    <th>Eliminar</th>       
                </tr>
                </thead>
                <tbody>
               @foreach ($estatus as $estatu)
                <tr>
                    <td>{{ $estatu->f_registro }}</td>
                    <td>{{ $estatu->periodo }}</td>
                    <td>@switch($estatu->estatus)
                            @case(1) 
                                Disponible
                            @break
                            @case(2) 
                                Asignado
                            @break
                            case(3) 
                                En Taller
                            @break
                            @case(4)
                                Fuera de Servicio
                            @break   
                            @endswitch
                    </td>
                    <td>{{ $estatu->motivo }}</td>

     <td>
      <form class="delete-form" action="{{ route('estatus.distroyEstatus', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="estatusid" value="{{ $estatu->id }}"  >
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