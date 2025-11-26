@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Panel</h1>
@stop

@section('content')
      


<div class="row col-md-12 ">

@php

if (auth()->check()) {
        $user = auth()->user();
        if($user->tipo==2){
          @endphp
@section('js')
    <script> location.href="/unidad"; </script>
@stop

@php
        }
    }
    
@endphp

<section class="col-lg-6 connectedSortable ui-sortable">

<x-adminlte-card   title="Disponible / Asignado"  theme="success" style="padding-right: 0px; padding-left: 0px;" >
<div class="col-md-12 row">
<div class="col-md-6">
 <?php 
 
 if(isset($disponibles[0]->cuenta)){
  $disponibles=$disponibles[0]->cuenta;
 }else{
  $disponibles=0;
 } 

  if(isset($asignados[0]->cuenta)){
  $asignados=$asignados[0]->cuenta;
 }else{
  $asignados=0;
 } 

  if(isset($entallers[0]->cuenta)){
  $entallers=$entallers[0]->cuenta;
 }else{
  $entallers=0;
 } 

  if(isset($fueras[0]->cuenta)){
  $fueras=$fueras[0]->cuenta;
 }else{
  $fueras=0;
 } 

 ?>
<canvas id="disponibleChart"></canvas>

  <p style="position:absolute; top: 45%; bottom:50%; right: 35%; left:36%; font-size:12px; text-align: center;"><strong>DISPONIBLES<br>{{ $disponibles  }}</strong><p>
</div>
<div class="col-md-6">
<table class="table">
  <tr style="background-color: black; color: white;">
    <td>Estatus</td>
    <td>Cant.</td>
    <td>%</td>
  </tr>
  <tr style="background-color: #52bb56; color: white;">
    <td>Disponible</td>
    <td>{{ $disponibles }}</td>
    <td>
    <?php 
    $total= $disponibles +$asignados;
    if($total==0){
      $porcentaje1 = 0;
    }else{
      $porcentaje1 = ($disponibles / $total) * 100;
    }
    ?>
    {{ round($porcentaje1,2) }} %</td>
  </tr>
  <tr style="background-color: #039cfd; color: white;">
    <td>Asignado</td>
    <td>{{ $asignados}}</td>
    <td><?php 
    if($total==0){
      $porcentaje2 = 0;
    }else{
      $porcentaje2 = ($asignados / $total) * 100;
    }
    ?>
    {{ round($porcentaje2,2) }} %</td>
  </tr>
</table>

</div>
</div>

</x-adminlte-card>
</section>

<section class="col-lg-6 connectedSortable ui-sortable">
<x-adminlte-card   title="En Taller / Fuera de Servicio"  theme="danger" style="padding-right: 0px; padding-left: 0px;" >
<div class="col-md-12 row">
<div class="col-md-6">
  <canvas id="tallerChart"></canvas>

  <p style="position:absolute; top: 45%; bottom:50%; right: 35%; left:36%; font-size:12px; text-align: center;"><strong>EN TALLER<br>{{ $entallers }}</strong><p>
</div>
<div class="col-md-6">
<table class="table">
  <tr style="background-color: black; color: white;">
    <td>Estatus</td>
    <td>Cant.</td>
    <td>%</td>
  </tr>
  <tr style="background-color: #f1b53d; color: white;">
    <td>En Taller</td>
    <td>
    {{ $entallers }}
  </td>
    <td>
      
    <?php 
    $total= $entallers +$fueras;
    if($total==0){
      $porcentaje1 = 0;
    }else{
        $porcentaje1 = ($entallers / $total) * 100;
    }
    ?>
    {{ round($porcentaje1,2) }} %
  </td>
  </tr>
  <tr style="background-color: #ef5350; color: white;">
    <td>Fuera de Servicio</td>
    <td>
      {{ $fueras }}
    </td>
    <td><?php 
    if($total==0){
        $porcentaje2 = 0;
    }else{
      $porcentaje2 = ($fueras / $total) * 100;
    }
   
    ?>
    {{ round($porcentaje2,2) }} %</td>
  </tr>
</table>

</div>
</div>

</x-adminlte-card>
</section>
</div>

<!-- Segunda Seccion -->

<div class="row col-md-12 ">


<section class="col-lg-6 connectedSortable ui-sortable">

<x-adminlte-card   title="Incidentes Abiertos"  theme="warning" style="padding-right: 0px; padding-left: 0px;" >
<div class="col-md-12 row">

<p><i class="fa-solid fa-bolt"></i>&nbsp;Incidentes</p>
<hr>
<table class="table">
  <tr>
    <th>Unidad</th>
    <th>No. Económico</th>
    <th>Dependencia</th>
    <th>Descripción</th>
  </tr>
 @foreach ($incidentes as $incidente)

<tr>
  <td>
    <a href="{{ route('unidad.incidente', $incidente->id) }}#tablaincidentes" >{{ $incidente->modelo }} {{ $incidente->marca }}</a>
  </td>
   <td>
    <a  >{{ $incidente->no_economico }} </a>
  </td>
   <td>
    @foreach ($dependencias as $dependencia)
      @if($dependencia->id==$incidente->dependencia)
        <a  >{{ $dependencia->dependencia }} </a>
      @endif
    @endforeach
  </td>
 
  <td>
{{ $incidente->descripcion_c }}
  </td>
</tr>

@endforeach

</table>

</div>

</x-adminlte-card>
</section>


<section class="col-lg-6 connectedSortable ui-sortable">

<x-adminlte-card   title="Próximos Eventos"  theme="info" style="padding-right: 0px; padding-left: 0px;" >
<div class="col-md-12 row">

<p><i class="fa-solid fa-truck"></i>&nbsp;Renovaciones de Documentos</p>
<hr>
<table class="table">
    <tr>
        <th>Unidad</th>
        <th>Dep.</th>
        <th>No. Eco.</th>
        <th>Cocumento</th>
        <th>Vigencia</th>
        <th>Estatus</th>
    </tr>
      @foreach ($seguros as $seguro)
      @if($seguro->dias <=30)
      <tr>
        <td>
          <a href="{{ route('unidad.documentos', $seguro->unidad) }}" >{{ $seguro->modelo }}<br>{{ $seguro->marca }}<br>{{ $seguro->placas }}</a>
        </td>
        <td>
    @foreach ($areas as $area)
      @if($area->id==$seguro->area)
        <a  >{{ $area->area }} </a>
      @endif
    @endforeach
  </td>
  <td>
          {{ $seguro->no_economico }}
        </td>
        <td>
          @switch($seguro->tipo)
            @case(1)
                Refrendos
                @break
            @case(2)
                Revista Vehicular
                @break
            @case(3)
                Poliza de Seguro
                @break
            @case(4)
                Placas
                @break
            @case(5)
                Alta Vehicular
                @break
            @case(6)
                Facturas
                @break
            @default
                Otro
                @endswitch
      
        </td>
      
        
         
        <td>
      {{ substr($seguro->vigencia,8,2).'/'.substr($seguro->vigencia,5,2).'/'.substr($seguro->vigencia,0,4) }}
        </td>
        <td>
          @if($seguro->dias>=1)
            <span class="bg-yellow" style="border-radius:5px; padding:5px 10px 5px 10px;">por vencer</span>
          @else
            <span class="bg-red" style="border-radius:5px; padding:5px 10px 5px 10px;">vencido</span>
          @endif
        </td>
      </tr>
      @endif
      @endforeach
</table>
</div>

</x-adminlte-card>
</section>



  </div>







<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('disponibleChart');

  new Chart(ctx, {
    type: 'doughnut',
    
    data: {
      labels: ['Disponible','Asignado'],
      datasets: [{
        label: '# unidades',
        data: [{{ $disponibles }}, {{ $asignados }}],
        backgroundColor: [
      'rgb(82,187,86)',
      'rgb(3,156,253)',
    ],
        borderWidth: 1
      }]
    },
    options: {
    plugins: {
      customCanvasBackgroundColor: {
        color: 'lightGreen',
      }
    }
  },
  cutoutPercentage: 95,
  });




  const ctxt = document.getElementById('tallerChart');

  new Chart(ctxt, {
    type: 'doughnut',
    
    data: {
      labels: ['En Taller','Fuera de Servicio'],
      datasets: [{
        label: '# unidades',
        data: [{{ $entallers }}, {{ $fueras }}],
        backgroundColor: [
      'rgb(241,181,61)',
      'rgb(239,83,80)',
    ],
        borderWidth: 1
      }]
    },
    options: {
    plugins: {
      customCanvasBackgroundColor: {
        color: 'lightGreen',
      }
    }
  },
  cutoutPercentage: 95,
  });
</script>
 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
