@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Editar Area</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('area.update', $areas->id ) }}" method="post">
    @csrf
    @method('PUT')
<div class="row col-md-12">
   <div class="col-md-3"> 
        <div class="input-group mb-3">
            <input type="text" name="area" value="{{ old('area', $areas->area) }}" class="form-control"
               placeholder="area" autofocus >

            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </div>
        </div>
        @error('area')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>
    <div class="col-md-3">


{{-- Minimal --}}
<x-adminlte-select2 name="dependencia_id"  data-placeholder="Selecciona Dependencia....">
    @foreach($dependencias as $dependencia)
        <option @if($dependencia->id == $areas->dependencia_id) @selected(true) @endif   value="{{ $dependencia->id }}"  >{{ $dependencia->dependencia }}</option>
    @endforeach
    
 
</x-adminlte-select2>


</div>
     <div class="col-md-3"> 
        <button type=submit name="guardartipo" class="btn btn-primary">
                   <span class="fa fa-save"></span>&nbsp;
                    Actualizar Datos
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
