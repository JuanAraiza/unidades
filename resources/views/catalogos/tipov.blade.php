@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Tipo de Vehículo</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">
<form action="" method="post">
{{-- Name field --}}
<div class="row col-md-12">
   <div class="col-md-6"> 
        <div class="input-group mb-3">
            <input type="text" name="tipo" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="tipo" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-car-side"></span>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-2"> 
        <i class="fa-solid fa-floppy-disk"></i>
        <button type=submit name="guardartipo" class="btn btn-primary">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Tipo
                </button>
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
