@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Nuevo Operador</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('operador.store') }}" method="post" enctype="multipart/form-data">
    @csrf

<div class="row col-md-12 mb-2">
    <div class="col-md-4 relative">
 <img id="imgPreview" style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="https://img.freepik.com/vector-premium/caracter-conductor-hombre-plano-gafas-sosteniendo-volante_176411-4416.jpg" alt="">
<div class="position-absolute " style="top: 8px; right:12px;" >
    <label class="bg-white px-4 py-2 rounded-lg cursor-pointer" style="cursor: pointer;">Cambiar imagen
        <input type="file" class="hidden" style="display: none;" name="fotos" accept="image/*" onchange="preview_image(event, '#imgPreview')">
    </label>

</div>
</div>
<div class="col-md-8 row">
   <div class="col-md-6"> 
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control"
               placeholder="Nombre" autofocus >
        </div>
        @error('nombre')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

  <div class="col-md-6"> 
       <div class="form-group">
            <label>Paterno</label>
            <input type="text" name="paterno" value="{{ old('paterno') }}" class="form-control"
               placeholder="Paterno" autofocus >
        </div>
        @error('paterno')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


      <div class="col-md-6"> 
        <div class="form-group">
            <label>Materno</label>
            <input type="text" name="materno" value="{{ old('materno') }}" class="form-control"
               placeholder="Materno" autofocus >

            
        </div>
        @error('materno')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>



 
    <div class="col-md-6">

<div class="form-group">
            <label>Area</label>
{{-- Minimal --}}
<x-adminlte-select2 name="area_id"  data-placeholder="Selecciona Area....">
    @foreach($areas as $area)
        <option @selected(old('area_id') == $area->id) value="{{ $area->id }}">{{ $area->area }}</option>
    @endforeach
    
 
</x-adminlte-select2>

</div>
</div>
          
  <div class="col-md-6"> 
        <div class="form-group">
            <label>Puesto</label>
            <input type="text" name="puesto" value="{{ old('puesto') }}" class="form-control"
               placeholder="Puesto" autofocus >
        </div>
        @error('puesto')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


    <div class="col-md-6"> 
        <div class="form-group">
            <label>Licencia</label>
            <input type="file" name="licencias"  class="form-control">
        </div>
     
    </div>

<div class="col-md-6">

<div class="form-group">
            <label>Vigencia</label>
            <input type="date" name="vigencia" value="{{ old('vigencia') }}" class="form-control"
               placeholder="Vigencia" autofocus >

</div>
</div>


     <div class="col-md-12"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit name="guardartipo" class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Operador
                </button>
        </div>
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
