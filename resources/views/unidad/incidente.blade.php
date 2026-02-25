@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Incidentes Unidad</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline">

<div class="row col-md-12 ">
    <div class="col-md-3">    
        <a href="{{ route('unidad.show', $unidades->id) }}" class="btn btn-primary btn-block">Ver Información</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.combustible', $unidades->id) }}" class="btn btn-default btn-block">Cargar Combustible</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.incidente', $unidades->id) }}" class="btn btn-info btn-block">Registro Incidentes</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.recordatorios', $unidades->id) }}" class="btn btn-success btn-block">Recordatorios</a>
    </div>
</div>
<div class="row col-md-12 ">&nbsp; </div>
<div class="row col-md-12 ">
    <div class="col-md-3">    
       <a href="{{ route('unidad.bitacora', $unidades->id) }}" class="btn bg-purple btn-block">Bitacora Usos</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.estatus', $unidades->id) }}" class="btn btn-warning btn-block">Estatus</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.documentos', $unidades->id) }}" class="btn btn-danger btn-block">Documentos</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('unidad.imagenes', $unidades->id) }}" class="btn bg-navy btn-block">Imagenes</a>
    </div>
</div>

</x-adminlte-card>




<div class="row col-md-12 ">

<x-adminlte-card  class="col-lg-8" title="REPORTAR INCIDENTE" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

<div class="row col-md-12 ">


   <div class="col-md-3"> 
        <div class="form-group">
            <label>Modelo de la unidad</label>
            <p>{{ $unidades->modelo }}</p>
        </div>
        
    </div>

  <div class="col-md-3"> 
       <div class="form-group">
            <label>Marca</label>
            <p>{{ $unidades->marca }}</p>
        </div>
    </div>

     <div class="col-md-3"> 
        <div class="form-group">
            <label>Color / Año</label>
            <p>{{ $unidades->color }} / {{ $unidades->anio }}</p>
        </div>
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Placas</label>
            <p>{{ $unidades->placas }}</p>
        </div>
    </div>




</div>


@if(isset($inci))
<form action="{{ route('incidente.updateIncidente', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    
    @csrf
    @method('POST')
<input type="hidden" name="id_incidente" value="{{ $inci->id }}"> 
@else
<form action="{{ route('unidad.guardarinci', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf
@endif



    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  

<div class="col-md-3"> 
        <div class="form-group">
            <label>Fecha de Reporte</label>
            <input type="date" name="fecha_reg"  value="@if(isset($inci)){{ $inci->fecha_reg }}@else{{ old('fecha_reg') }} @endif" class="form-control">
        </div>
        @error('fecha_reg')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


<div class="col-md-6"> 
        <div class="form-group">
            <label>Descripcion corta</label>
            <input type="text" name="descripcion_c"   value="@if(isset($inci)){{ $inci->descripcion_c }}@else{{ old('descripcion_c') }}@endif" class="form-control"
               placeholder="Descripcion" autofocus >
        </div>
        @error('descripcion_c')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Importancia</label>
             {{-- Minimal --}}
            <x-adminlte-select2 name="importancia"  data-placeholder="Selecciona Importancia....">
                        <option @if(isset($inci)) @selected($inci->importancia) @else @selected(old('Moredada')) @endif value="Moredada">Moredada</option>
                        <option @if(isset($inci)) @selected($inci->importancia) @else @selected(old('Critica')) @endif value="Critica">Critica</option>
                        <option @if(isset($inci)) @selected($inci->importancia) @else @selected(old('Baja')) @endif value="Baja">Baja</option>
            </x-adminlte-select2>
        </div>
    </div>



    <div class="col-md-3"> 
        <div class="form-group">
            <label>Fotografia / Imagen</label>
            @if(isset($inci))
            <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($inci->imagen) }}" alt="">
            @endif
            <input type="file" name="foto"  class="form-control">
        </div>
    </div>


    <div class="col-md-3"> 
        <div class="form-group">
            <label>Fecha de Vencimiento</label>
            <input type="date" name="fecha_ven"  value="@if(isset($inci)){{ $inci->fecha_ven }}@else{{ old('fecha_ven') }}@endif" class="form-control">
        </div>
        @error('fecha_ven')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

     <div class="col-md-3"> 
        <div class="form-group">
            <label>Odómetro/Horómetro</label>
            <input type="text" name="odometro"  onKeyPress="return valida(event)"  value="@if(isset($inci)){{ $inci->odometro }}@else{{ old('odometro') }}@endif" class="form-control"
               placeholder="1000" maxlength="5" autofocus >
        </div>
        @error('odometro')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>

<div class="col-md-3"> 
       <div class="form-group">
            <label>Operador</label>
      {{-- Minimal --}}
            <x-adminlte-select2 name="operador"  data-placeholder="Selecciona Operador....">
                    @foreach($operadores as $operador)
                    @if(isset($inci))
                        <option @selected(old('operador',  $inci->operador) == $operador->id) value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}</option>
                    @else
                        <option @selected(old('operador') == $operador->id) value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}</option>
                    @endif
                        
                    @endforeach
            </x-adminlte-select2>
        </div>
      
    </div>

    <div class="col-md-9"> 
            <div class="form-group">
                <label>Descripcion Detallada</label>
    
    <x-adminlte-textarea name="descripcion" >
        @if(isset($inci)){{ $inci->descripcion }}@else{{ old('descripcion') }}@endif
    </x-adminlte-textarea>
            </div>
    </div>

<div class="col-md-3"> 
        <div class="form-group">
            <label>&nbsp;</label>
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                   @if(isset($inci))
                    Actualizar
                    @else
                    Registrar
                    @endif
                </button>
        </div>
    </div>


</div>



</form>


</x-adminlte-card>

<div class="row col-md-4 ">
    <div class="col-md-1 ">&nbsp;</div>
<x-adminlte-card  class="col-lg-11" title="IMAGEN" theme="success" style="padding-right: 0px; padding-left: 0px;" >
 <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($unidades->imagen) }}" alt="">

</x-adminlte-card>
</div>



</div>





<x-adminlte-card theme="primary" theme-mode="outline">




 <table id="tablaincidentes" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Reporte</th>
                  <th>Vencimiento</th>
                  <th>Incidente</th>
                  <th>Estatus</th>
                  <th>Imagen</th>
                  <th>Reporto</th>
                    <th>Editar</th>
                    <th>Cerrar</th> 
                    <th>Eliminar</th>       
                </tr>
                </thead>
                <tbody>
               @foreach ($incidentes as $incidente)
                <tr>
                    <td>{{ $incidente->id }}</td>
                    <td>{{ $incidente->fecha_reg }}</td>
                    <td>{{ $incidente->fecha_ven }}</td>
                    <td>{{ $incidente->descripcion }}</td>
                    <td>
                        @switch($incidente->estatus)
                            @case(1)
                                <span class="badge badge-success">Cualquiera</span>
                                @break
                            @case(2)
                                <span class="badge badge-warning">Pendiente</span>
                                @break
                            @case(3)
                                <span class="badge badge-danger">Resuelto</span>
                                @break
                            @case(4)
                                <span class="badge badge-danger">Cerrado</span>
                                @break
                        @endswitch
                    <td>
                        @if ($incidente->imagen)
                            <img src="{{ Storage::url($incidente->imagen) }}" alt="Imagen" class="img-fluid" style="max-width: 100px;">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    
                    <td>
                        @foreach ($operadores as $operador)
                            @if ($operador->id == $incidente->operador)
                                {{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}
                            @endif
                    @endforeach
                </td>
                                                         
      <td>
        <form  action="{{ route('incidente.editIncidente', $unidades->id )}}" method="post">
                @csrf
                @method('POST')
               <input type="hidden" name="unidad" value="{{ $unidades->id }}"  >
                <input type="hidden" name="incidente" value="{{ $incidente->id }}"  >
              <button  class="btn btn-warning"><span  class="fas fa-pencil"></span></button>
</form>       
    </td>
      <td>
@if($incidente->estatus != 4)

      <form class="cerrar-form" action="{{ route('incidente.cerrarIncidente', $unidades->id) }}" method="post">
                @csrf
                @method('POST')
               <input type="hidden" name="unidad" value="{{ $unidades->id }}"  >
                <input type="hidden" name="id_incidente" value="{{ $incidente->id }}"  >
              <button class="btn bg-black">  <span class="fas fa-close"></span></button>
</form>  
@endif                 
</td>
     <td>
      <form class="delete-form" action="{{ route('incidente.destroyIncidente', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
               <input type="hidden" name="unidad" value="{{ $unidades->id }}"  >
                <input type="hidden" name="incidente" value="{{ $incidente->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
                
            </tr>
                @endforeach
                </tbody>
               
              </table>
</x-adminlte-card>


<x-adminlte-card theme="primary" theme-mode="outline">

  
<div>
  <canvas id="myChart"></canvas>
</div>
<?php function getMeses($m) {
     $meses = [
        1 => 'Ene',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Abr',
        5 => 'May',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Ago',
        9 => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dic'
    ];
    return $meses[$m] ?? 'Desconocido';
}
    ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [ @foreach ($graincidentes as $graincidente)
    '{{ getMeses((int)date("m", strtotime($graincidente->fecha)))."/".date("y", strtotime($graincidente->fecha)) }}',
  @endforeach],
      datasets: [{
        label: '# Incidentes',
        data: [
            @foreach ($graincidentes as $graincidente)
    {{ $graincidente->cuenta }},
  @endforeach
 ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


</x-adminlte-card>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>


      <script>


$('#tablaincidentes').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});
      </script>

@stop

@push('js')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', (e) =>{
                e.preventDefault();
                Swal.fire({
                    title: "¿Estas Seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Si, Eliminar!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        document.querySelectorAll('.cerrar-form').forEach(form => {
            form.addEventListener('submit', (e) =>{
                e.preventDefault();
                Swal.fire({
                    title: "¿Estas Seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Si, Cerrar!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush