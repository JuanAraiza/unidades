@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('usuarios.update', $usuarios->id ) }}" method="post"  enctype="multipart/form-data">
    @csrf
    @method('PUT')


<div class="row col-md-12">

   <div class="col-md-4"> 
         <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name', $usuarios->name) }}" class="form-control"
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
            <input type="text" name="email" value="{{ old('email', $usuarios->email) }}" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" >
        </div>
        @error('email')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-4"> 
         <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">

            <input type="hidden" name="passwordold" value="{{ $usuarios->password }}" >
        </div>
        @error('password')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>



    <div class="col-md-4">

 <div class="form-group">
            <label>Dependencia</label>
{{-- Minimal --}}
  <x-adminlte-select2 name="dependencia"  data-placeholder="Selecciona Dependencia....">
    @foreach($dependencias as $dependencia)
        <option @if($dependencia->id == $usuarios->dependencia) @selected(true) @endif   value="{{ $dependencia->id }}"  >{{ $dependencia->dependencia }}</option>
    @endforeach
    

</x-adminlte-select2>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
            <label>Tipo</label>
{{-- Minimal --}}
<x-adminlte-select2 name="tipo"  data-placeholder="Selecciona Tipo....">
        <option @if($usuarios->tipo == 2) @selected(true) @endif  value="2">Direccion</option>
        <option @if($usuarios->tipo == 3) @selected(true) @endif  value="3">Gasolinera</option>
        <option @if($usuarios->tipo == 1) @selected(true) @endif  value="1">Administrador</option>
</x-adminlte-select2>
</div>
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
