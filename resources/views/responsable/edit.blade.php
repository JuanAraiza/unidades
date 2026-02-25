@extends('adminlte::page')

@section('title', 'AVIZOR')

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

<div class="col-md-3">
<div class="form-group">
            <label>Dependencia</label>
{{-- Minimal --}}
<x-adminlte-select2 name="dependencia"  id="dependencia"  data-placeholder="Selecciona Dependencia...." onChange="cargarAreas(this.value)">
    @foreach($dependencias as $dependencia)
        <option @selected(old('dependencia', $responsables->dependencia) == $dependencia->id) value="{{ $dependencia->id }}">{{ $dependencia->dependencia }}</option>
    @endforeach
</x-adminlte-select2>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Área asignada</label>
{{-- Minimal --}}
<x-adminlte-select2 name="area_id"  id="area_id" data-placeholder="Selecciona Area....">
    @foreach($areas as $area)
        <option @selected(old('area_id', $responsables->area_id) == $area->id) value="{{ $area->id }}">{{ $area->area }}</option>
    @endforeach
</x-adminlte-select2>
</div>
</div>





 <div class="col-md-3"> 
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




     <div class="col-md-3"> 
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
    <script>
    function cargarAreas(depedendencia) {
               // alert(dependencia.value);
                
                var url = '{{ route("area.subareas") }}';
                var data = { dependencia: dependencia.value };

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: data,
                    success: function(data) {
                        //console.log(data);
                        var opciones = '';
                        $.each(data, function(index, value) {
                            opciones += '<option value="' + value.id + '">' + value.area + '</option>';
                        });
                        $('#area_id').html(opciones).select2();
                    }
                });
                
            }
    console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
