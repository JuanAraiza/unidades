@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Cargar Combustible Unidad</h1>
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

<x-adminlte-card  class="col-lg-8" title="CARGAR COMBUSTIBLE" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

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



<form action="{{ route('unidad.guardarvale', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  
    <div class="col-md-3"> 
        <div class="form-group">
            <label>Kilometraje</label>
            <input type="text" name="km"  onKeyPress="return valida(event)"  value="{{ old('km') }}" class="form-control"
               placeholder="Kilometraje" autofocus >
        </div>
        @error('km')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Justificación</label>
            <input type="text" name="justificacion" value="{{ old('justificacion') }}" class="form-control"
               placeholder="Justificación"  >
        </div>
        @error('justificacion')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Destino</label>
            <input type="text" name="destino" value="{{ old('destino') }}" class="form-control"
               placeholder="Destino"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

 <div class="col-md-3"> 
        <div class="form-group">
            <label>Litros</label>
            <input type="text" name="litros"  onKeyPress="return valida(event)"  value="{{ old('litros') }}" class="form-control"
               placeholder="Litros" maxlength="5" autofocus >
        </div>
        @error('litros')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>





<div class="col-md-3"> 
       <div class="form-group">
            <label>Tipo Combustible</label>
      {{-- Minimal --}}
            <x-adminlte-select2 name="tipo_com"  data-placeholder="Selecciona Tipo....">
                   @if ( $unidades->combustible  == 'Gasolina' )
                        <option @selected(old('tipo_com')) value="1">Gas 1</option>
                        <option @selected(old('tipo_com')) value="2">Gas 2</option>
                        @elseif ( $unidades->combustible  == 'Diesel')
                        <option @selected(old('tipo_com')) value="3">Diesel</option>
                          @else
                        <option @selected(old('tipo_com')) value="4">Gas LP</option>
                        @endif
              
            </x-adminlte-select2>
        </div>
      
    </div>

<div class="col-md-3"> 
       <div class="form-group">
            <label>Operador</label>
      {{-- Minimal --}}
            <x-adminlte-select2 name="operador"  data-placeholder="Selecciona Operador....">
                    @foreach($operadores as $operador)
                        <option @selected(old('operador') == $operador->id) value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}</option>
                    @endforeach
            </x-adminlte-select2>
        </div>
      
    </div>
    

<div class="col-md-3">
<div class="form-group">
            <label>Área</label>
{{-- Minimal --}}
<x-adminlte-select2 name="area"  data-placeholder="Selecciona Area....">
    @foreach($areas as $area)
        <option @selected(old('area') == $area->id) value="{{ $area->id }}">{{ $area->area }}</option>
    @endforeach
</x-adminlte-select2>
</div>
</div>

<div class="col-md-3"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Solicitar Vale
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

<table id="tablacombustible" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Litros</th>
                  <th>Operador</th>
                  <th>Justificación</th>
                  <th>Destino</th>
                  <th>Tipo Combustible</th>
                  <th>Kilometraje</th>
                  <th>Área</th>
               
                  <!--  <th></th>     -->  
                </tr>
                </thead>
                <tbody>
    @foreach ($vales as $vale)
                <tr>
                    <td>{{ $vale->folio }}</td>
                    <td>{{ $vale->created_at->format('d/m/Y') }}</td>
                    <td>{{ $vale->litros }}</td>
                    <td>
                        @foreach($operadores as $operador)
                        {{ $vale->operador == $operador->id ? $operador->nombre . ' ' . $operador->paterno . ' ' . $operador->materno : '' }}
                    @endforeach
             
                </td>
                    <td>{{ $vale->justificacion }}</td>
                    <td>{{ $vale->destino }}</td>
                    <td>{{ $vale->tipo_com == 1 ? 'Gas 1' : ($vale->tipo_com == 2 ? 'Gas 2' : ($vale->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}</td>
                    <td>{{ $vale->km }}</td>
                    <td> 
                        @foreach($areas as $area)
                        {{ $vale->area == $area->id ? $area->area : '' }}
    @endforeach
                         </td>
          


<!--
                      <td>


                        <a type="button" class="btn btn-warning" href="{{ route('unidad.imvale', $vale->id) }}" target="_blank">
<i class="fa-solid fa-print"></i>
</a>
</td>
-->

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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>


 <script>

$("#tablacombustible").dataTable().fnDestroy();
$('#tablacombustible').DataTable({
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
