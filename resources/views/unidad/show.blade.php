@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Información Unidad</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline">

<div class="row col-md-12 ">
    <div class="col-md-3">    
        <a href="{{ route('unidad.show', $unidades->id) }}" class="btn btn-default btn-block">Ver Información</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.combustible', $unidades->id) }}" class="btn btn-secondary btn-block">Cargar Combustible</a>
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


<x-adminlte-card theme="primary" theme-mode="outline">
 

    @csrf

<div class="row col-md-12 mb-2">
    <div class="col-md-6 relative">
 <img id="imgPreview" style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($unidades->imagen) }}" alt="">

</div>
<div class="col-md-6 row">

    <div class="col-md-6">
<div class="form-group">
            <label>Tipo Unidad</label>
<p>{{ $unidades->tunidad }}</p>
</div>
</div>

   <div class="col-md-6"> 
        <div class="form-group">
            <label>Modelo de la unidad</label>
            <p>{{ $unidades->modelo }}</p>
        </div>
        
    </div>

  <div class="col-md-6"> 
       <div class="form-group">
            <label>Marca</label>
            <p>{{ $unidades->marca }}</p>
        </div>
    </div>


      <div class="col-md-6"> 
        <div class="form-group">
            <label>Año</label>
            <p>{{ $unidades->anio }}</p>
        </div>
    </div>

     <div class="col-md-6"> 
        <div class="form-group">
            <label>Color</label>
            <p>{{ $unidades->color }}</p>
        </div>
    </div>


<div class="col-md-6"> 
        <div class="form-group">
            <label>Placas</label>
            <p>{{ $unidades->placas }}</p>
        </div>
    </div>

<div class="col-md-6"> 
        <div class="form-group">
            <label>No. Económicos</label>
            <p>{{ $unidades->no_economico }}</p>
        </div>
    </div>

 <div class="col-md-6">
<div class="form-group">
            <label>Combustible</label>
<p>{{ $unidades->combustible }}</p>
</div>
</div>

@php
/*
<div class="col-md-6">
<div class="form-group">
            <label>Tipo Vehiculo</label>

            @foreach($tipos as $tipo)
               @if ($tipo->id == $unidades->tipov )
             <p>{{ $tipo->tipo }}</p>
            @endif
            @endforeach
</div>
</div>
*/
@endphp


<div class="col-md-6">
<div class="form-group">
            <label>Estatus</label>
@switch($unidades->estatus )
    @case(1)
    <p>Disponible</p>
        @break
 
    @case(2)
      <p>En Taller</p>
        @break
 
   @case(3)
      <p>Fuera de Servicio</p>
        @break
@endswitch
</div>
</div>

<div class="col-md-6"> 
        <div class="form-group">
            <label>No. Serie</label>
            <p>{{ $unidades->no_serie }}</p>
        </div>
    </div>


</div>
</div>

<div class="row col-md-12">



    





<div class="col-md-3">
<div class="form-group">
            <label>Inicio de Estadísticas</label>
            @switch($unidades->inicio_est )
    @case(1)
    <p>Fecha de Registro</p>
        @break
 
    @case(2)
      <p>Fecha de Compra</p>
        @break

@endswitch

</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Medida de uso</label>
<p>{{ $unidades->medida_usu }}</p>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Medida de combustible</label>
<p>{{ $unidades->medida_con }}</p>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Dependencia</label>
@foreach($dependencias as $dependencia)
               @if ($dependencia->id == $unidades->dependencia )
             <p>{{ $dependencia->dependencia }}</p>
            @endif
            @endforeach
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Área asignada</label>
            @foreach($areas as $area)
               @if ($area->id == $unidades->area )
             <p>{{ $area->area }}</p>
            @endif
            @endforeach
</div>
</div>


          
  <div class="col-md-3"> 
        <div class="form-group">
            <label>Cilindros</label>
            <p>{{ $unidades->cilindros }}</p>
        </div>
    </div>







     <div class="col-md-3"> 
        <div class="form-group">
            <label>Uso</label>
            <p>{{ $unidades->uso }}</p>
        </div>
    </div>
 <div class="col-md-3"> 
        <div class="form-group">
            <label>Aseguradora</label>
            <p>{{ $unidades->aseguradora }}</p>
        </div>
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Responsable</label>
             @php
                        $responsables = \DB::select("select * from responsable where id in(select responsable from resp_noes where no_economico='".$unidades->no_economico ."')");
                    @endphp
                    <p>
                    @foreach($responsables as $responsable)
                        {{ $responsable->nombre }} {{ $responsable->paterno }} {{ $responsable->materno }}
                    @endforeach
            </p>
        </div>
    </div>

     
<div class="col-md-3"> 
        <div class="form-group">
            <label>Operador</label>
            @php
                        $operadores = \DB::select("select * from operador where id in(select operador from combustibles where unidad='".$unidades->id ."')");
                    @endphp
                    <p>
                    @foreach($operadores as $operadores)
                        {{ $operadores->nombre }} {{ $operadores->paterno }} {{ $operadores->materno }}<br>
                    @endforeach
            </p>
        </div>
    </div>

    </div>




    <div class="col-md-12"> 
        <div class="form-group">
            <label>Detalles</label>
            <p>{{ $unidades->detalles }}</p>
        
    </div>
</div>
   
    
</div>

</x-adminlte-card>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
