@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Editar Precio Fecha {{ substr($precios->fecha,8,2).'-'.substr($precios->fecha,5,2).'-'.substr($precios->fecha,0,4) }} {{ $precios->hora }}</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('preciogas.update', $precios->id ) }}" method="post">
    @csrf
    @method('PUT')
<div class="row col-md-12">
      <div class="col-md-2"> 
        <div class="form-group">
            <label>Gas 1</label>
            <input type="text" name="gas1"  onKeyPress="return valida(event)"  value="{{ old('gas1', $precios->gas1) }}" class="form-control"
               placeholder="Gas1" maxlength="5" autofocus >
        </div>
        @error('gas1')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

<div class="col-md-2"> 
       <div class="form-group">
            <label>Gas 2</label>
            <input type="text" onKeyPress="return valida(event)"  name="gas2" value="{{ old('gas2', $precios->gas2) }}" class="form-control"
               placeholder="Gas 2"  maxlength="5" >
        </div>
        @error('gas2')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


      <div class="col-md-2"> 
        <div class="form-group">
            <label>Diesel</label>
            <input type="text"  onKeyPress="return valida(event)"  name="diesel" value="{{ old('diesel', $precios->diesel) }}" class="form-control"
               placeholder="Diesel"   maxlength="5">

            
        </div>
        @error('materno')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

  <div class="col-md-2"> 
        <div class="form-group">
            <label>LP</label>
            <input type="text" onKeyPress="return valida(event)" name="lp" value="{{ old('lp', $precios->lp) }}" class="form-control"
               placeholder="Lp" maxlength="5" >
        </div>
        @error('lp')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

 
    <div class="col-md-4">

<div class="form-group">
            <label>Proveedor</label>
{{-- Minimal --}}
<x-adminlte-select2 name="proveedor"  data-placeholder="Selecciona Area....">
    @foreach($proveedores as $proveedor)
        <option @selected(old('proveedor',$precios->proveedor) == $proveedor->id) value="{{ $proveedor->id }}">{{ $proveedor->gasolinera }}</option>
    @endforeach
    
 
</x-adminlte-select2>

</div>
</div>

<input type="hidden" name="fecha" value="{{ $precios->fecha }}">
<input type="hidden" name="hora" value="{{ $precios->hora }}">

     <div class="col-md-4"> 
        <div class="form-group">
        <label>&nbsp;</label>
        <button type=submit name="guardartipo" class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Actualizar Datos
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
