@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Nuevo Registro</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('presupuestoc.store') }}" method="post">
    @csrf

<div class="row col-md-12">
   <div class="col-md-3"> 
        <div class="form-group">
            <label>Ejecicio</label>
            <input type="text" name="ejercicio" value="{{ old('ejercicio') }}" class="form-control"
               placeholder="0000"  onKeyPress="return valida(event)"  autofocus  >
        </div>
        @error('ejercicio')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>


      <div class="col-md-3"> 
        <div class="form-group">
            <label>Fondo</label>
            <input type="text" name="fondo" value="{{ old('fondo') }}" class="form-control"
               placeholder="000000000"  onKeyPress="return valida(event)"  autofocus  >
        </div>
        @error('fondo')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Programa</label>
            <input type="text" name="programa" value="{{ old('programa') }}" class="form-control"
               placeholder="GTM0A000000" autofocus  >
        </div>
        @error('programa')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Centro Gestor</label>
            <input type="text" name="centro_g" value="{{ old('centro_g') }}" class="form-control"
               placeholder="GTM0A000000" autofocus  >
        </div>
        @error('centro_g')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-3">
<div class="form-group">
            <label>Nombre del centro gestor</label>
{{-- Minimal --}}
<x-adminlte-select2 name="dependencia" id="dependencia"  data-placeholder="Selecciona Dependencia...." >
    <option @selected(old('depdnencia')) value="0">--</option>
    @foreach($dependencias as $dependencia)
        <option @selected(old('depdnencia') == $dependencia->id) value="{{ $dependencia->id }}">{{ $dependencia->dependencia }}</option>
    @endforeach
</x-adminlte-select2>
</div>
</div>


<div class="col-md-3"> 
        <div class="form-group">
            <label>Área Funcional</label>
            <input type="text" name="area_fun" value="{{ old('area_fun') }}" class="form-control"
               placeholder="000" autofocus  >
        </div>
        @error('area_fun')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>



    <div class="col-md-3"> 
        <div class="form-group">
            <label>Asignado</label>
            <input type="text" name="asignado" value="{{ old('asignado') }}" class="form-control"
               placeholder="00000" autofocus  >
        </div>
        @error('asignado')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Disponible para compra</label>
            <input type="text" name="disponible" value="{{ old('disponible') }}" class="form-control"
               placeholder="00000" autofocus  >
        </div>
        @error('disponible')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>


     <div class="col-md-12"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit name="guardartipo" class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Registro
                </button>
        </div>
    </div>
    
</div>
</form>
</x-adminlte-card>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
