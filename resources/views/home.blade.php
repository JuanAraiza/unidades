@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Panel</h1>
@stop

@section('content')
      
<div class="row col-md-12 ">


<section class="col-lg-6 connectedSortable ui-sortable">

<x-adminlte-card   title="Disponible / Asignado"  theme="info" style="padding-right: 0px; padding-left: 0px;" >
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
  $disponasignadosibles=0;
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

  <p style="position:absolute; top: 45%; bottom:50%; right: 35%; left:36%; font-size:12px; text-align: center;"><strong>DISPONIBLES<br>{{ $asignados }}</strong><p>
</div>
<div class="col-md-6">
<table class="table">
  <tr style="background-color: black; color: white;">
    <td>Estatus</td>
    <td>Cantidad</td>
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
    {{ $porcentaje1 }} %</td>
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
    {{ $porcentaje2 }} %</td>
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
    <td>Cantidad</td>
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
    {{ $porcentaje1 }} %
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
    {{ $porcentaje2 }} %</td>
  </tr>
</table>

</div>
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
        data: ['{{ $disponibles }}', '{{ $asignados }}'],
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
        ddata: ['{{ $entallers }}', '{{ $fueras }}'],
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
