@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Nueva Dependencia</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('dependencia.store') }}" method="post">
    @csrf

<div class="row col-md-12">
   
<div class="col-md-4"> 
        <div class="input-group mb-3">
            <input type="text" name="dependencia" value="{{ old('dependencia') }}" class="form-control"
               placeholder="dependencia" autofocus >

            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </div>
        </div>
        @error('dependencia')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-4"> 
        <div class="input-group mb-3">
            <input type="text" name="director" value="{{ old('director') }}" class="form-control"
               placeholder="Nombre Director"  >
        </div>
        @error('director')
            <span style="color:crimson;">
                {{$director}}
            </span>
        @enderror
    </div>
     <div class="col-md-3"> 
        <button type=submit name="guardartipo" class="btn btn-primary">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Dependencia
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
