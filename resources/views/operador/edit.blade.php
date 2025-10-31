@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Editar Operador</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('operador.update', $operadores->id ) }}" method="post"  enctype="multipart/form-data">
    @csrf
    @method('PUT')


<div class="row col-md-12">


 <div class="col-md-4 relative">
 <img id="imgPreview" style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($operadores->foto) }}" alt="">
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
            <input type="text" name="nombre" value="{{ old('nombre', $operadores->nombre) }}" class="form-control"
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
            <input type="text" name="paterno" value="{{ old('paterno', $operadores->paterno) }}" class="form-control"
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
            <input type="text" name="materno" value="{{ old('materno', $operadores->materno) }}" class="form-control"
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
            <label>Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $operadores->telefono) }}" class="form-control"
               placeholder="Teléfono" autofocus >

            
        </div>
        @error('telefono')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label>Domicilio</label>
            <input type="text" name="direccion" value="{{ old('direccion', $operadores->direccion) }}" class="form-control"
               placeholder="Dirección" autofocus >

            
        </div>
        @error('direccion')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


 
    <div class="col-md-6">

<div class="form-group">
            <label>Dependencia</label>
{{-- Minimal --}}
<x-adminlte-select2 name="dependencia"  data-placeholder="Selecciona Dependencia....">
    @foreach($dependencias as $dependencia)
        <option @if($dependencia->id == $operadores->dependenecia) @selected(true) @endif  value="{{ $dependencia->id }}">{{ $dependencia->dependencia }}</option>
    @endforeach
    
 
</x-adminlte-select2>

</div>
</div>


    <div class="col-md-6">

 <div class="form-group">
            <label>Area</label>
{{-- Minimal --}}
<x-adminlte-select2 name="area_id"  data-placeholder="Selecciona Dependencia....">
    @foreach($areas as $area)
        <option @if($area->id == $operadores->area_id) @selected(true) @endif   value="{{ $area->id }}"  >{{ $area->area }}</option>
    @endforeach
    

</x-adminlte-select2>
</div>
</div>


 <div class="col-md-6"> 
         <div class="form-group">
            <label>Puesto</label>
            <input type="text" name="puesto" value="{{ old('puesto', $operadores->puesto) }}" class="form-control"
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
            <input type="date" name="vigencia" value="{{ old('vigencia', $operadores->vigencia) }}" class="form-control"
               placeholder="Vigencia" autofocus >

</div>
</div>

     <div class="col-md-12"> 
        <div class="form-group">
        <label>&nbsp;</label>
        <button type=submit name="guardartipo" class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Actualizar Datos
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
