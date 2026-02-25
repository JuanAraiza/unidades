@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')

<x-adminlte-card theme="primary" theme-mode="outline">
<form action="{{ route('usuarios.store') }}" method="post" enctype="multipart/form-data">
    @csrf

<div class="row col-md-12 mb-2">
 

   <div class="col-md-4"> 
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
               placeholder="Nombre" autofocus >
        </div>
        @error('name')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>



   <div class="col-md-4"> 
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


  <div class="col-md-4"> 
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">
</div>
        </div>

<div class="col-md-4">
    <div class="form-group">
                <label>Dependencia</label>
    {{-- Minimal --}}
    <x-adminlte-select2 name="dependencia"  data-placeholder="Selecciona Dependencia....">
        @foreach($dependencias as $dependencia)
            <option @selected(old('dependencia') == $dependencia->id) value="{{ $dependencia->id }}">{{ $dependencia->dependencia }}</option>
        @endforeach
    </x-adminlte-select2>
    </div>
</div>
          

   <div class="col-md-4">

<div class="form-group">
            <label>Tipo</label>
{{-- Minimal --}}
<x-adminlte-select2 name="tipo"  data-placeholder="Selecciona Tipo....">
        <option @selected(old('tipo') == 2) value="2">Direccion</option>
        <option @selected(old('tipo') == 3) value="3">Gasolinera</option>
        <option @selected(old('tipo') == 1) value="1">Administrador</option>
</x-adminlte-select2>
</div>
</div>
          
     <div class="col-md-4"> 
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
