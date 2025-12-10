@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Editar Unidad</h1>
@stop

@section('content')



<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('unidad.update', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf
@method('PUT')
<div class="row col-md-12 mb-2">
    <div class="col-md-6 relative">
 <img id="imgPreview" style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($unidades->imagen) }}" alt="">
<div class="position-absolute " style="top: 8px; right:12px;" >
    <label class="bg-white px-4 py-2 rounded-lg cursor-pointer" style="cursor: pointer;">Cambiar imagen
        <input type="file" class="hidden" style="display: none;" name="image" accept="image/*" onchange="preview_image(event, '#imgPreview')">
    </label>

</div>
</div>
<div class="col-md-6 row">

    <div class="col-md-6">
<div class="form-group">
            <label>Tipo Unidad</label>
{{-- Minimal --}}
<x-adminlte-select2 name="tunidad"  data-placeholder="Selecciona Tipo....">
        <option @selected(old('tunidad', $unidades->tunidad) == 'Vehiculos') value="Vehiculos">Vehículos</option>
        <option @selected(old('tunidad', $unidades->tunidad) == 'Maquinaria') value="Maquinaria">Maquinaria</option>
        <option @selected(old('tunidad', $unidades->tunidad) == 'Herramientas') value="Herramientas">Herramientas</option>
        <option @selected(old('tunidad', $unidades->tunidad) == 'Otros') value="Otros">Otros</option>
</x-adminlte-select2>
</div>
</div>

   <div class="col-md-6"> 
        <div class="form-group">
            <label>Modelo de la unidad</label>
            <input type="text" name="modelo" value="{{ old('modelo', $unidades->modelo) }}" class="form-control"
               placeholder="Modelo" autofocus >
        </div>
        @error('modelo')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

  <div class="col-md-6"> 
       <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" value="{{ old('marca', $unidades->marca) }}" class="form-control"
               placeholder="Marca"  >
        </div>
        @error('marca')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


      <div class="col-md-6"> 
        <div class="form-group">
            <label>Año</label>
            <input type="text" name="anio" value="{{ old('anio', $unidades->anio) }}" class="form-control"
               placeholder="Año"  >

            
        </div>
        @error('anio')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

     <div class="col-md-6"> 
        <div class="form-group">
            <label>Color</label>
            <input type="text" name="color" value="{{ old('color', $unidades->color) }}" class="form-control"
               placeholder="Color"  >

            
        </div>
        @error('color')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-6"> 
        <div class="form-group">
            <label>Placas</label>
            <input type="text" name="placas" value="{{ old('placas', $unidades->placas) }}" class="form-control"
               placeholder="Placas"  >

            
        </div>
        @error('placas')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

<div class="col-md-6"> 
        <div class="form-group">
            <label>No. Económicos</label>
            <input type="text" name="no_economico" value="{{ old('no_economico', $unidades->no_economico) }}" class="form-control"
               placeholder="No. Económico"  >

            
        </div>
        @error('no_economico')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

 <div class="col-md-6">
<div class="form-group">
            <label>Combustible</label>
{{-- Minimal --}}
<x-adminlte-select2 name="combustible"  data-placeholder="Selecciona Tipo....">
        <option @selected(old('combustible', $unidades->combustible) == 'Gasolina') value="Gasolina">Gasolina</option>
        <option @selected(old('combustible', $unidades->combustible) == 'Diesel') value="Diesel">Diesel</option>
        <option @selected(old('combustible', $unidades->combustible) == 'Gas LP') value="Gas LP">Gas LP</option>
</x-adminlte-select2>
</div>
</div>

@php
/*
<div class="col-md-6">
<div class="form-group">
            <label>Tipo Vehiculo</label>
{{-- Minimal --}}
<x-adminlte-select2 name="tipov"  data-placeholder="Selecciona Tipo Vehiculo....">
    @foreach($tipos as $tipov)
        <option @selected(old('tipov', $unidades->tipov) == $tipov->id) value="{{ $tipov->id }}">{{ $tipov->tipo }}</option>
    @endforeach
</x-adminlte-select2>
</div>
</div>
*/
@endphp




<div class="col-md-6">
<div class="form-group">
            <label>Estatus</label>
{{-- Minimal --}}
<x-adminlte-select2 name="estatus"  data-placeholder="Selecciona Estatus....">
        <option @selected(old('estatus', $unidades->estatus) == '1') value="1">Disponible</option>
        <option @selected(old('estatus', $unidades->estatus) == '2') value="2">En Taller</option>
        <option @selected(old('estatus', $unidades->estatus) == '3') value="3">Fuera de Servicio</option>
</x-adminlte-select2>
</div>
</div>

<div class="col-md-6"> 
        <div class="form-group">
            <label>No. Serie</label>
            <input type="text" name="no_serie" value="{{ old('no_serie', $unidades->no_serie) }}" class="form-control"
               placeholder="No. Serie"  >

            
        </div>
        @error('no_serie')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


</div>
</div>

<div class="row col-md-12">



    





<div class="col-md-3">
<div class="form-group">
            <label>Inicio de Estadísticas</label>
{{-- Minimal --}}
<x-adminlte-select2 name="inicio_est"  data-placeholder="Selecciona Inicio....">
        <option @selected(old('inicio_est', $unidades->inicio_est) == '1') value="1">Fecha de Registro</option>
        <option @selected(old('inicio_est', $unidades->inicio_est) == '2') value="2">Fecha de Compra</option>
</x-adminlte-select2>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Medida de uso</label>
{{-- Minimal --}}
<x-adminlte-select2 name="medida_usu"  data-placeholder="Selecciona Inicio....">
        <option @selected(old('medida_uso', $unidades->medida_uso) == 'Kilometros') value="Kilometros">Kilometros</option>
        <option @selected(old('medida_uso', $unidades->medida_uso) == 'Horas') value="Horas">Horas</option>
</x-adminlte-select2>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Medida de combustible</label>
{{-- Minimal --}}
<x-adminlte-select2 name="medida_con"  data-placeholder="Selecciona Inicio....">
        <option @selected(old('medida_con', $unidades->medida_con) == 'Litros') value="Litros">Litros</option>
</x-adminlte-select2>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
            <label>Dependencia</label>
{{-- Minimal --}}
<x-adminlte-select2 name="dependencia"  id="dependencia"  data-placeholder="Selecciona Dependencia...." onChange="cargarAreas(this.value)">
    @foreach($dependencias as $dependencia)
        <option @selected(old('dependencia', $unidades->dependencia) == $dependencia->id) value="{{ $dependencia->id }}">{{ $dependencia->dependencia }}</option>
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
        <option @selected(old('area_id', $unidades->area_id) == $area->id) value="{{ $area->id }}">{{ $area->area }}</option>
    @endforeach
</x-adminlte-select2>
</div>
</div>


          
  <div class="col-md-3"> 
        <div class="form-group">
            <label>Cilindros</label>
            <input type="text" name="cilindros" value="{{ old('cilindros', $unidades->cilindros) }}" class="form-control"
               placeholder="Cilindros"  >
        </div>
        @error('cilindros')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>




     <div class="col-md-3"> 
        <div class="form-group">
            <label>Uso</label>
            <input type="text" name="uso" value="{{ old('uso', $unidades->uso) }}" class="form-control"
               placeholder="Uso"  >
        </div>
        @error('uso')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Aseguradora</label>
            <input type="text" name="aseguradora" value="{{ old('aseguradora', $unidades->aseguradora) }}" class="form-control"
               placeholder="Aseguradora"  >
        </div>
        @error('aseguradora')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


    


    <div class="col-md-12"> 
        <div class="form-group">
            <label>Detalles</label>
            <textarea name="detalles" rows="5" class="form-control"
               placeholder="Detalles"  >{{ old('detalles', $unidades->detalles) }}</textarea>
        </div>
        @error('detalles')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

     <div class="col-md-4"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Unidad
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
