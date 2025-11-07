@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Documentos Unidad</h1>
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

<x-adminlte-card  class="col-lg-8" title="UNIDAD" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

<div class="row col-md-12 ">


   <div class="col-md-4"> 
        <div class="form-group">
            <label>Modelo de la unidad</label>
            <p>{{ $unidades->modelo }}</p>
        </div>
        
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <label>Numero Eco.</label>
            <p>{{ $unidades->no_economico }}</p>
        </div>
        
    </div>

  <div class="col-md-4"> 
       <div class="form-group">
            <label>Marca</label>
            <p>{{ $unidades->marca }}</p>
        </div>
    </div>

     <div class="col-md-4"> 
        <div class="form-group">
            <label>Color</label>
            <p>{{ $unidades->color }}</p>
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <label>Año</label>
            <p>{{ $unidades->anio }}</p>
        </div>
    </div>

    <div class="col-md-4"> 
        <div class="form-group">
            <label>Placas</label>
            <p>{{ $unidades->placas }}</p>
        </div>
    </div>




</div>

</x-adminlte-card>

<div class="row col-md-4 ">
    <div class="col-md-1 ">&nbsp;</div>
<x-adminlte-card  class="col-lg-11" title="IMAGEN" theme="success" style="padding-right: 0px; padding-left: 0px;" >
 <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($unidades->imagen) }}" alt="">

</x-adminlte-card>
</div>



</div>



@php

$cvencidos=0;
$cporven=0;
$dias=0;


if(isset($vrefrendos->dias)){
$dias = $vrefrendos->dias;
if($dias>30){
   }elseif($dias<=30 && $dias>=1){
    $cporven++;;
   }else{
    $cvencidos++;
   }
   }


$dias=0;
if(isset($vplacas->dias)){
$dias = $vplacas->dias;
if($dias>30){
   }elseif($dias<=30 && $dias>=1){
    $cporven++;;
   }else{
    $cvencidos++;
   }
   }


$dias=0;
   if(isset($vfacturas->dias)){
   $dias = $vfacturas->dias;
if($dias>30){
    $vig=1;
   }elseif($dias<=30 && $dias>=1){
    $cporven++;;
   }else{
    $cvencidos++;
   }
   }

$dias=0;
   if(isset($vpolizas->dias)){
   $dias = $vpolizas->dias;
if($dias>30){
    $vig=1;
   }elseif($dias<=30 && $dias>=1){
    $cporven++;;
   }else{
    $cvencidos++;
   }
   }


$dias=0;
   if(isset($vrevistas->dias)){
   $dias = $vrevistas->dias;
if($dias>30){
    $vig=1;
   }elseif($dias<=30 && $dias>=1){
    $cporven++;;
   }else{
    $cvencidos++;
   }
   }

$dias=0;
   if(isset($valtas->dias)){
   $dias = $valtas->dias;
if($dias>30){
    $vig=1;
   }elseif($dias<=30 && $dias>=1){
    $cporven++;;
   }else{
    $cvencidos++;
   }
   }

@endphp



<div class="row col-md-12 ">
  
<div class="col-md-12 ">
@if($cporven>=1)
 <span class="badge badge-warning  col-md-12 " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff; text-align:left;"><i class="fa-solid fa-triangle-exclamation"></i> <strong>Alerta:</strong> {{ $cporven }} Documentos están próximos a vencer en los siguientes 30 días</span>

@endif

@if($cvencidos>=1)
<br><br>
 <span class="badge badge-danger  col-md-12 " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; text-align:left;"><i class="fa-solid fa-bell"></i> <strong>Urgente:</strong> {{ $cvencidos }} Documento(s) Vencido(s) </span>

@endif
<br><br>
</div>
</div>

<!-- Inicio Refrendos -->

<div class="row col-md-12 ">

<div class="col-md-6">
<div class="card "  style="border-left: 3px solid #007bff; border-top:none;"> 
  <div class="card-header">
    <h3 class="card-title mt-2"><strong>Refrenos</strong></h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDocu1">
 <span><i style="color:#f8cf2d;" class="fa-solid fa-folder-open"></i></span>
</button>
     
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
@foreach ($refrendos as $refrendo)
<div class="row ">
    <div class="col-md-7">
<strong>{{ $refrendo->titulo }}</strong><br>
    <sapn style="font-size: 13px; color:darkgrey">Fecha: {{ $refrendo->fecha }} | Vence: {{ $refrendo->vencimiento }} <br>
    Solicito: {{ $refrendo->usuario }}  </sapn>
</div>


<div class="col-md-5 row">
<div class="col-md-6">


@php

$fechaIniciosa = new \Carbon\Carbon($refrendo->vencimiento);
$fechaFinal = \Carbon\Carbon::now();
$diasRestantes = $fechaFinal->diffInDays($fechaIniciosa);
if($diasRestantes>30){
    $vig=1;
   }elseif($diasRestantes<=30 && $diasRestantes>=1){
    $vig=2;
   }else{
    $vig=3;
   }
@endphp
@if($vig==1)
 <span class="badge badge-success" style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vigente</span>
@elseif($vig==2)
 <span class="badge badge-warning " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff;">Por Vencer</span>
@else
 <span class="badge badge-danger " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vencido</span>
@endif
  


</div>
<div class="col-md-3">
<a  class="btn btn-primary " href="{{ Storage::url($refrendo->documento) }}" target="_blank">
                               <i class="fa-solid fa-eye"></i>
                            </a>
</div>
       <div class="col-md-3">                     
   <form class="delete-form " action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $refrendo->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>       
</div>


</div>
</div>
<hr>
@endforeach
</div>
  
  <!-- /.card-body -->
   <?php /*
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
  */ ?>
</div>
<!-- /.card -->


<!--  Modal 1 -->

<!-- Modal -->
<div class="modal fade" id="modalDocu1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Refrendos</strong> | Agregar Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarDocumento', $unidades->id ) }}" method="post" class="col-md-12" enctype="multipart/form-data">
    @csrf

      <div class="modal-body col-md-12" style="background-color: #f7f7f7ff;">
        
    

      
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Nombre del Documento</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
               placeholder="Titulo"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
<input type="hidden" name="tipo" value="1"> 

      <input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-12"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="vencimiento"   class="form-control">
        </div>
        @error('vencimiento')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-12"> 
        <div class="form-group">
            <label>Usuario que solicito</label>
            <input type="text" name="usuario" value="{{ old('ususario') }}" class="form-control"
               placeholder="Usuario"  >
        </div>
        @error('ususario')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-12"> 
        <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo"  class="form-control">
        </div>
    </div>




        
    
    </div>


      <div class="modal-footer">
      <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Documento
                </button>
      </div>
</form>
@php
} 
@endphp
    
    </div>
  </div>
</div>


<!-- Fin Modal 1 -->
</div>

<!-- Inicio Revista -->

<div class="col-md-6">
<div class="card"  style="border-left: 3px solid #007bff; border-top:none;"> 
  <div class="card-header">
    <h3 class="card-title mt-2"><strong>Revista Vehicular</strong></h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDocu2">
 <span><i style="color:#f8cf2d;" class="fa-solid fa-folder-open"></i></span>
</button>
     
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
@foreach ($revistas as $revista)
<div class="row ">
    <div class="col-md-7">
<strong>{{ $revista->titulo }}</strong><br>
    <sapn style="font-size: 13px; color:darkgrey">Fecha: {{ $revista->fecha }} | Vence: {{ $revista->vencimiento }} <br>
    Solicito: {{ $revista->usuario }}  </sapn>
</div>


<div class="col-md-5 row">
<div class="col-md-6">


@php

$fechaIniciosa = new \Carbon\Carbon($revista->vencimiento);
$fechaFinal = \Carbon\Carbon::now();
$diasRestantes = $fechaFinal->diffInDays($fechaIniciosa);
if($diasRestantes>30){
    $vig=1;
   }elseif($diasRestantes<=30 && $diasRestantes>=1){
    $vig=2;
   }else{
    $vig=3;
   }
@endphp
@if($vig==1)
 <span class="badge badge-success" style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vigente</span>
@elseif($vig==2)
 <span class="badge badge-warning " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff;">Por Vencer</span>
@else
 <span class="badge badge-danger " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vencido</span>
@endif
  


</div>
<div class="col-md-3">
<a  class="btn btn-primary " href="{{ Storage::url($revista->documento) }}" target="_blank">
                               <i class="fa-solid fa-eye"></i>
                            </a>
</div>
       <div class="col-md-3">                     
   <form class="delete-form " action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $revista->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>       
</div>


</div>
</div>
<hr>
@endforeach
</div>
  
  <!-- /.card-body -->
   <?php /*
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
  */ ?>
</div>
<!-- /.card -->








<!--  Modal 1 -->

<!-- Modal -->
<div class="modal fade" id="modalDocu2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Revista Vehicular</strong> | Agregar Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarDocumento', $unidades->id ) }}" method="post" class="col-md-12" enctype="multipart/form-data">
    @csrf

      <div class="modal-body col-md-12" style="background-color: #f7f7f7ff;">
        
    

      
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Nombre del Documento</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
               placeholder="Titulo"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
<input type="hidden" name="tipo" value="2"> 

      <input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-12"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="vencimiento"   class="form-control">
        </div>
        @error('vencimiento')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-12"> 
        <div class="form-group">
            <label>Usuario que solicito</label>
            <input type="text" name="usuario" value="{{ old('ususario') }}" class="form-control"
               placeholder="Usuario"  >
        </div>
        @error('ususario')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-12"> 
        <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo"  class="form-control">
        </div>
    </div>




        
    
    </div>


      <div class="modal-footer">
      <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Documento
                </button>
      </div>
</form>
@php
} 
@endphp
    
    </div>
  </div>
</div>


<!-- Fin Modal 1 -->
</div>


<!-- Inicio Revista -->

<div class="col-md-6">
<div class="card"  style="border-left: 3px solid #007bff; border-top:none;"> 
  <div class="card-header">
    <h3 class="card-title mt-2"><strong>Poliza Seguro</strong></h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDocu3">
 <span><i style="color:#f8cf2d;" class="fa-solid fa-folder-open"></i></span>
</button>
     
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
@foreach ($polizas as $poliza)
<div class="row ">
    <div class="col-md-7">
<strong>{{ $poliza->titulo }}</strong><br>
    <sapn style="font-size: 13px; color:darkgrey">Fecha: {{ $poliza->fecha }} | Vence: {{ $poliza->vencimiento }} <br>
    Solicito: {{ $poliza->usuario }}  </sapn>
</div>


<div class="col-md-5 row">
<div class="col-md-6">


@php

$fechaIniciosa = new \Carbon\Carbon($poliza->vencimiento);
$fechaFinal = \Carbon\Carbon::now();
$diasRestantes = $fechaFinal->diffInDays($fechaIniciosa);
if($diasRestantes>30){
    $vig=1;
   }elseif($diasRestantes<=30 && $diasRestantes>=1){
    $vig=2;
   }else{
    $vig=3;
   }
@endphp
@if($vig==1)
 <span class="badge badge-success" style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vigente</span>
@elseif($vig==2)
 <span class="badge badge-warning " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff;">Por Vencer</span>
@else
 <span class="badge badge-danger " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vencido</span>
@endif
  


</div>
<div class="col-md-3">
<a  class="btn btn-primary " href="{{ Storage::url($poliza->documento) }}" target="_blank">
                               <i class="fa-solid fa-eye"></i>
                            </a>
</div>
       <div class="col-md-3">                     
   <form class="delete-form " action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $poliza->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>       
</div>


</div>
</div>
<hr>
@endforeach
</div>
  
  <!-- /.card-body -->
   <?php /*
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
  */ ?>
</div>
<!-- /.card -->

<!--  Modal 1 -->

<!-- Modal -->
<div class="modal fade" id="modalDocu3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Poliza Seguro</strong> | Agregar Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarDocumento', $unidades->id ) }}" method="post" class="col-md-12" enctype="multipart/form-data">
    @csrf

      <div class="modal-body col-md-12" style="background-color: #f7f7f7ff;">
        
    

      
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Nombre del Documento</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
               placeholder="Titulo"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
<input type="hidden" name="tipo" value="3"> 

      <input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-12"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="vencimiento"   class="form-control">
        </div>
        @error('vencimiento')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-12"> 
        <div class="form-group">
            <label>Usuario que solicito</label>
            <input type="text" name="usuario" value="{{ old('ususario') }}" class="form-control"
               placeholder="Usuario"  >
        </div>
        @error('ususario')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-12"> 
        <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo"  class="form-control">
        </div>
    </div>




        
    
    </div>


      <div class="modal-footer">
      <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Documento
                </button>
      </div>
</form>
@php
} 
@endphp
    
    </div>
  </div>
</div>


<!-- Fin Modal 1 -->
</div>



<!-- Inicio Placas -->

<div class="col-md-6">
<div class="card"  style="border-left: 3px solid #007bff; border-top:none;"> 
  <div class="card-header">
    <h3 class="card-title mt-2"><strong>Placas</strong></h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDocu4">
 <span><i style="color:#f8cf2d;" class="fa-solid fa-folder-open"></i></span>
</button>
     
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
@foreach ($placas as $placa)
<div class="row ">
    <div class="col-md-7">
<strong>{{ $placa->titulo }}</strong><br>
    <sapn style="font-size: 13px; color:darkgrey">Fecha: {{ $placa->fecha }} | Vence: {{ $placa->vencimiento }} <br>
    Solicito: {{ $placa->usuario }}  </sapn>
</div>


<div class="col-md-5 row">
<div class="col-md-6">


@php

$fechaIniciosa = new \Carbon\Carbon($placa->vencimiento);
$fechaFinal = \Carbon\Carbon::now();
$diasRestantes = $fechaFinal->diffInDays($fechaIniciosa);
if($diasRestantes>30){
    $vig=1;
   }elseif($diasRestantes<=30 && $diasRestantes>=1){
    $vig=2;
   }else{
    $vig=3;
   }
@endphp
@if($vig==1)
 <span class="badge badge-success" style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vigente</span>
@elseif($vig==2)
 <span class="badge badge-warning " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff;">Por Vencer</span>
@else
 <span class="badge badge-danger " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vencido</span>
@endif
  


</div>
<div class="col-md-3">
<a  class="btn btn-primary " href="{{ Storage::url($placa->documento) }}" target="_blank">
                               <i class="fa-solid fa-eye"></i>
                            </a>
</div>
       <div class="col-md-3">                     
   <form class="delete-form " action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $placa->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>       
</div>


</div>
</div>
<hr>
@endforeach
</div>
  
  <!-- /.card-body -->
   <?php /*
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
  */ ?>
</div>
<!-- /.card -->

<!--  Modal 1 -->

<!-- Modal -->
<div class="modal fade" id="modalDocu4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Placas</strong> | Agregar Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarDocumento', $unidades->id ) }}" method="post" class="col-md-12" enctype="multipart/form-data">
    @csrf

      <div class="modal-body col-md-12" style="background-color: #f7f7f7ff;">
        
    

      
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Nombre del Documento</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
               placeholder="Titulo"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
<input type="hidden" name="tipo" value="4"> 

      <input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-12"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="vencimiento"   class="form-control">
        </div>
        @error('vencimiento')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-12"> 
        <div class="form-group">
            <label>Usuario que solicito</label>
            <input type="text" name="usuario" value="{{ old('ususario') }}" class="form-control"
               placeholder="Usuario"  >
        </div>
        @error('ususario')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-12"> 
        <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo"  class="form-control">
        </div>
    </div>
    </div>


      <div class="modal-footer">
      <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Documento
                </button>
      </div>
</form>
@php
} 
@endphp
    
    </div>
  </div>
</div>


<!-- Fin Modal 1 -->
</div>


<!-- Inicio Alta Vehicular -->

<div class="col-md-6">
<div class="card"  style="border-left: 3px solid #007bff; border-top:none;"> 
  <div class="card-header">
    <h3 class="card-title mt-2"><strong>Alta Vehicular</strong></h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDocu5">
 <span><i style="color:#f8cf2d;" class="fa-solid fa-folder-open"></i></span>
</button>
     
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
@foreach ($altas as $alta)
<div class="row ">
    <div class="col-md-7">
<strong>{{ $alta->titulo }}</strong><br>
    <sapn style="font-size: 13px; color:darkgrey">Fecha: {{ $alta->fecha }} | Vence: {{ $alta->vencimiento }} <br>
    Solicito: {{ $alta->usuario }}  </sapn>
</div>


<div class="col-md-5 row">
<div class="col-md-6">


@php

$fechaIniciosa = new \Carbon\Carbon($alta->vencimiento);
$fechaFinal = \Carbon\Carbon::now();
$diasRestantes = $fechaFinal->diffInDays($fechaIniciosa);
if($diasRestantes>30){
    $vig=1;
   }elseif($diasRestantes<=30 && $diasRestantes>=1){
    $vig=2;
   }else{
    $vig=3;
   }
@endphp
@if($vig==1)
 <span class="badge badge-success" style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vigente</span>
@elseif($vig==2)
 <span class="badge badge-warning " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff;">Por Vencer</span>
@else
 <span class="badge badge-danger " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vencido</span>
@endif
  


</div>
<div class="col-md-3">
<a  class="btn btn-primary " href="{{ Storage::url($alta->documento) }}" target="_blank">
                               <i class="fa-solid fa-eye"></i>
                            </a>
</div>
       <div class="col-md-3">                     
   <form class="delete-form " action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $alta->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>       
</div>


</div>
</div>
<hr>
@endforeach
</div>
  
  <!-- /.card-body -->
   <?php /*
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
  */ ?>
</div>
<!-- /.card -->

<!--  Modal 1 -->

<!-- Modal -->
<div class="modal fade" id="modalDocu5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Alta Vehicular</strong> | Agregar Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarDocumento', $unidades->id ) }}" method="post" class="col-md-12" enctype="multipart/form-data">
    @csrf

      <div class="modal-body col-md-12" style="background-color: #f7f7f7ff;">
        
    

      
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Nombre del Documento</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
               placeholder="Titulo"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
<input type="hidden" name="tipo" value="5"> 

      <input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-12"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="vencimiento"   class="form-control">
        </div>
        @error('vencimiento')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-12"> 
        <div class="form-group">
            <label>Usuario que solicito</label>
            <input type="text" name="usuario" value="{{ old('ususario') }}" class="form-control"
               placeholder="Usuario"  >
        </div>
        @error('ususario')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-12"> 
        <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo"  class="form-control">
        </div>
    </div>
    </div>


      <div class="modal-footer">
      <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Documento
                </button>
      </div>
</form>
@php
} 
@endphp
    
    </div>
  </div>
</div>


<!-- Fin Modal 1 -->
</div>



<!-- Inicio Facturas -->

<div class="col-md-6">
<div class="card"  style="border-left: 3px solid #007bff; border-top:none;"> 
  <div class="card-header">
    <h3 class="card-title mt-2"><strong>Facturas</strong></h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDocu6">
 <span><i style="color:#f8cf2d;" class="fa-solid fa-folder-open"></i></span>
</button>
     
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
@foreach ($facturas as $factura)
<div class="row ">
    <div class="col-md-7">
<strong>{{ $factura->titulo }}</strong><br>
    <sapn style="font-size: 13px; color:darkgrey">Fecha: {{ $factura->fecha }} | Vence: {{ $factura->vencimiento }} <br>
    Solicito: {{ $factura->usuario }}  </sapn>
</div>


<div class="col-md-5 row">
<div class="col-md-6">


@php

$fechaIniciosa = new \Carbon\Carbon($factura->vencimiento);
$fechaFinal = \Carbon\Carbon::now();
$diasRestantes = $fechaFinal->diffInDays($fechaIniciosa);
if($diasRestantes>30){
    $vig=1;
   }elseif($diasRestantes<=30 && $diasRestantes>=1){
    $vig=2;
   }else{
    $vig=3;
   }
@endphp
@if($vig==1)
 <span class="badge badge-success" style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vigente</span>
@elseif($vig==2)
 <span class="badge badge-warning " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%; color:#fff;">Por Vencer</span>
@else
 <span class="badge badge-danger " style="padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; width:100%;">Vencido</span>
@endif
  


</div>
<div class="col-md-3">
<a  class="btn btn-primary " href="{{ Storage::url($factura->documento) }}" target="_blank">
                               <i class="fa-solid fa-eye"></i>
                            </a>
</div>
       <div class="col-md-3">                     
   <form class="delete-form " action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $factura->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>       
</div>


</div>
</div>
<hr>
@endforeach
</div>
  
  <!-- /.card-body -->
   <?php /*
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
  */ ?>
</div>
<!-- /.card -->

<!--  Modal 1 -->

<!-- Modal -->
<div class="modal fade" id="modalDocu6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Facturas</strong> | Agregar Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @php
$user = auth()->user();
if($user->tipo==1){
@endphp
<form action="{{ route('unidad.guardarDocumento', $unidades->id ) }}" method="post" class="col-md-12" enctype="multipart/form-data">
    @csrf

      <div class="modal-body col-md-12" style="background-color: #f7f7f7ff;">
        
    

      
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Nombre del Documento</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
               placeholder="Titulo"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
<input type="hidden" name="tipo" value="6"> 

      <input type="hidden" name="unidad" value="{{ $unidades->id }}">  
<div class="col-md-12"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="vencimiento"   class="form-control">
        </div>
        @error('vencimiento')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-12"> 
        <div class="form-group">
            <label>Usuario que solicito</label>
            <input type="text" name="usuario" value="{{ old('ususario') }}" class="form-control"
               placeholder="Usuario"  >
        </div>
        @error('ususario')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-12"> 
        <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo"  class="form-control">
        </div>
    </div>
    </div>


      <div class="modal-footer">
      <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
              
                    Agregar Documento
                </button>
      </div>
</form>
@php
} 
@endphp
    
    </div>
  </div>
</div>


<!-- Fin Modal 1 -->
</div>



</div>

<?php /*

<x-adminlte-card theme="primary" theme-mode="outline">

 <table id="tabladocumentos" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Documento</th>
                  <th>Fecha Vencimiento</th>
                  <th>Archivo</th>
                  
                    <th>Eliminar</th>       
                </tr>
                </thead>
                <tbody>
               @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->titulo }}</td>
                    <td>{{ $documento->vencimiento }}</td>
                   
                    <td>
                 
                            <a  class="btn btn-primary" href="{{ Storage::url($documento->documento) }}" target="_blank">
                                Ver Documento
                            </a>
                               
                        
                    </td>
                    
                                            
    
     <td>
      <form class="delete-form" action="{{ route('documentosu.distroyDocumento', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="documento" value="{{ $documento->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
                
            </tr>
                @endforeach
                </tbody>
               
              </table>



</x-adminlte-card>

*/ ?>

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