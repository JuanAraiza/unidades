@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Nuevo Proveedor</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('proveedor.store') }}" method="post">
    @csrf

<div class="row col-md-12">
   <div class="col-md-4"> 
        <div class="form-group">
            <label>Gasolinera</label>
            <input type="text" name="gasolinera" value="{{ old('gasolinera') }}" class="form-control"
               placeholder="Gasolinera" autofocus >
        </div>
        @error('gasolinera')
            <span style="color:crimson;">
                 {{$message}}
            </span>
        @enderror
    </div>

  <div class="col-md-4"> 
       <div class="form-group">
            <label>RFC</label>
            <input type="text" name="rfc" value="{{ old('rfc') }}" class="form-control"
               placeholder="RFC" autofocus >
        </div>
        @error('rfc')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


      <div class="col-md-4"> 
        <div class="form-group">
            <label>Razon Social</label>
            <input type="text" name="razon_social" value="{{ old('razon_social') }}" class="form-control"
               placeholder="Razon Social" autofocus >

            
        </div>
        @error('razon_social')
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
                    Guardar Proveedor
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
