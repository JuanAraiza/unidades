@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Editar Responsable</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('responsable.update', $responsables->id ) }}" method="post">
    @csrf
    @method('PUT')
<div class="row col-md-12">
   <div class="col-md-4"> 
         <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $responsables->nombre) }}" class="form-control"
               placeholder="Nombre" autofocus >
        </div>
        @error('nombre')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

<div class="col-md-4"> 
         <div class="form-group">
            <label>Paterno</label>
            <input type="text" name="paterno" value="{{ old('paterno', $responsables->paterno) }}" class="form-control"
               placeholder="Paterno" autofocus >
        </div>
        @error('paterno')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-4"> 
         <div class="form-group">
            <label>Materno</label>
            <input type="text" name="materno" value="{{ old('materno', $responsables->materno) }}" class="form-control"
               placeholder="Materno" autofocus >
        </div>
        @error('materno')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>



    <div class="col-md-4">

 <div class="form-group">
            <label>Area</label>
{{-- Minimal --}}
<x-adminlte-select2 name="area_id"  data-placeholder="Selecciona Dependencia....">
    @foreach($areas as $area)
        <option @if($area->id == $responsables->area_id) @selected(true) @endif   value="{{ $area->id }}"  >{{ $area->area }}</option>
    @endforeach
    

</x-adminlte-select2>
</div>
</div>


 <div class="col-md-4"> 
         <div class="form-group">
            <label>Puesto</label>
            <input type="text" name="puesto" value="{{ old('puesto', $responsables->puesto) }}" class="form-control"
               placeholder="Puesto" autofocus >
        </div>
        @error('puesto')
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
