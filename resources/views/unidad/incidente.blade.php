@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Incidentes Unidad</h1>
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

<x-adminlte-card  class="col-lg-8" title="REPORTAR INCIDENTE" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

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



<form action="{{ route('unidad.guardarinci', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  

<div class="col-md-3"> 
        <div class="form-group">
            <label>Fecha de Reporte</label>
            <input type="date" name="fecha_reg"  value="{{ old('fecha_reg') }}" class="form-control">
        </div>
        @error('fecha_reg')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-6"> 
        <div class="form-group">
            <label>Descripcion corta</label>
            <input type="text" name="descripcion_c"   value="{{ old('descripcion_c') }}" class="form-control"
               placeholder="Descripcion" autofocus >
        </div>
        @error('descripcion_c')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Importancia</label>
             {{-- Minimal --}}
            <x-adminlte-select2 name="importancia"  data-placeholder="Selecciona Importancia....">
                        <option @selected(old('Moredada')) value="Moredada">Moredada</option>
                        <option @selected(old('Critica')) value="Critica">Critica</option>
                        <option @selected(old('Baja')) value="Baja">Baja</option>
            </x-adminlte-select2>
        </div>
    </div>

    <div class="col-md-10"> 
            <div class="form-group">
                <label>Descripcion Detallada</label>
    <x-adminlte-textarea name="descripcion" placeholder="Descripcion..."/>
            </div>
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Fotografia / Imagen</label>
            <input type="file" name="foto"  class="form-control">
        </div>
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="fecha_ven"  value="{{ old('fecha_ven') }}" class="form-control">
        </div>
        @error('fecha_ven')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

     <div class="col-md-3"> 
        <div class="form-group">
            <label>Odómetro/Horómetro</label>
            <input type="text" name="odometro"  onKeyPress="return valida(event)"  value="{{ old('odometro') }}" class="form-control"
               placeholder="1000" maxlength="5" autofocus >
        </div>
        @error('odometro')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>



<div class="col-md-3"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Registrar
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





{{-- Setup data for datatables --}}
@php
$heads = [
        'ID',
    'Reporte',
    'Vencimiento',
    'Incidente',
    'Estatus',
    'Imagen',
    'Reporto',
    'Acciones'
];



$config = [
    
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable  id="table2" :heads="$heads" head-theme="dark" :config="$config"
    striped hoverable bordered compressed>
    @foreach ($incidentes as $incidente)
                <tr>
                    <td>{{ $incidente->id }}</td>
                    <td>{{ $incidente->fecha_reg }}</td>
                    <td>{{ $incidente->fecha_ven }}</td>
                    <td>{{ $incidente->descripcion }}</td>
                    <td>
                        @switch($incidente->estatus)
                            @case(1)
                                <span class="badge badge-success">Cualquiera</span>
                                @break
                            @case(2)
                                <span class="badge badge-warning">Pendiente</span>
                                @break
                            @case(3)
                                <span class="badge badge-danger">Resuelto</span>
                                @break
                            @case(4)
                                <span class="badge badge-danger">Cerrado</span>
                                @break
                        @endswitch
                    <td>
                        @if ($incidente->imagen)
                            <img src="{{ Storage::url($incidente->imagen) }}" alt="Imagen" class="img-fluid" style="max-width: 100px;">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    
                    <td>
                        @foreach ($usuarios as $usuario)
                            @if ($usuario->id == $incidente->id_user)
                                {{ $usuario->name }}
                            @endif
                    @endforeach
                </td>
                                                         

                </tr>
                @endforeach

               
</x-adminlte-datatable>

</x-adminlte-card>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
