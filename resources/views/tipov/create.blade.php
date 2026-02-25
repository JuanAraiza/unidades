@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Nuevo Tipo de Vehículo</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('tipov.store') }}" method="post">
    @csrf

<div class="row col-md-12">
   <div class="col-md-6"> 
        <div class="input-group mb-3">
            <input type="text" name="tipo" value="{{ old('tipo') }}" class="form-control"
               placeholder="tipo" autofocus >

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-car-side"></span>
                </div>
            </div>
        </div>
        @error('tipo')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
     <div class="col-md-2"> 
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
