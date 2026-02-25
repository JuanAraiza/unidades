@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Nuevo Precio</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('preciogas.store') }}" method="post">
    @csrf

<div class="row col-md-12">
   <div class="col-md-2"> 
        <div class="form-group">
            <label>Gas 1</label>
            <input type="text" name="gas1"  onKeyPress="return valida(event)"  value="{{ old('gas1') }}" class="form-control"
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
            <input type="text" onKeyPress="return valida(event)"  name="gas2" value="{{ old('gas2') }}" class="form-control"
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
            <input type="text"  onKeyPress="return valida(event)"  name="diesel" value="{{ old('diesel') }}" class="form-control"
               placeholder="Diesel"   maxlength="5">

            
        </div>
        @error('diesel')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

  <div class="col-md-2"> 
        <div class="form-group">
            <label>LP</label>
            <input type="text" onKeyPress="return valida(event)" name="lp" value="{{ old('lp') }}" class="form-control"
               placeholder="Lp" maxlength="5" >
        </div>
        @error('lp')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

 
    <div class="col-md-2">

<div class="form-group">
            <label>Proveedor</label>
{{-- Minimal --}}
<x-adminlte-select2 name="proveedor"  data-placeholder="Selecciona Area....">
    @foreach($proveedores as $proveedor)
        <option @selected(old('proveedor') == $proveedor->id) value="{{ $proveedor->id }}">{{ $proveedor->gasolinera }}</option>
    @endforeach
    
 
</x-adminlte-select2>

</div>
</div>
        
<div class="col-md-2"> 
        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control">
        </div>
        @error('fecha')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


     <div class="col-md-4"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit name="guardartipo" class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Precio del Día
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
