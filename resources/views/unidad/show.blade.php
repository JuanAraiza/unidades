@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Unidad</h1>
@stop

@section('content')



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



</div>
</div>

<div class="row col-md-12">



    


<div class="col-md-3"> 
        <div class="form-group">
            <label>No. Serie</label>
            <p>{{ $unidades->no_serie }}</p>
        </div>
    </div>


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
            <label>Responsable de la Unidad</label>
            @foreach($responsables as $responsable)
               @if ($responsable->id == $unidades->responsable )
             <p>{{ $responsable->nombre }} {{ $responsable->paterno }} {{ $responsable->materno }}</p>
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
            <label>Factura</label>
            @if($unidades->factura!='')
            <p><a href="{{ Storage::url($unidades->factura) }}" target="_blank" class="btn btn-warning">Ver Archivo</a></p>
            @endif
    </div>
     
    </div>


     <div class="col-md-3"> 
        <div class="form-group">
            <label>Uso</label>
            <p>{{ $unidades->uso }}</p>
        </div>
    </div>


    <div class="col-md-12"> 
        <div class="form-group">
            <label>Detalles</label>
            <p>{{ $unidades->detalles }}</p>
        
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
