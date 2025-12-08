@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Bitacora de Uso Unidad</h1>
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

<x-adminlte-card  class="col-lg-8" title="BITACORA DE USO" theme="primary" style="padding-right: 0px; padding-left: 0px;" >

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
<form action="{{ route('bitacora.updateBitacora', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    
    @csrf
    @method('POST')
<input type="hidden" name="id_bitacora" value="{{ $bita->id }}"> 
@else
<form action="{{ route('unidad.guardarbita', $unidades->id ) }}" method="post" enctype="multipart/form-data">
    @csrf
@endif



    <div class="row col-md-12 mb-2">
<input type="hidden" name="unidad" value="{{ $unidades->id }}">  

<div class="col-md-3"> 
        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="fecha_reg"  value="@if(isset($bita)){{ $bita->fecha_reg }}@else{{ old('fecha_reg') }} @endif" class="form-control">
        </div>
        @error('fecha_reg')
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
                        <option @selected(old('operador') == $operador->id) value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}</option>
                    @endforeach
            </x-adminlte-select2>
        </div>
      
    </div>
 
    <div class="col-md-6"> 
            <div class="form-group">
                <label>Actividad</label>
     <input type="text" name="actividad" value="@if(isset($bita)){{ $bita->actividad }}@else{{ old('actividad') }} @endif" class="form-control"
               placeholder="Aseguradora"  >
    
            </div>
    </div>

    <div class="col-md-4"> 
        <div class="form-group">
            <label>Evidencia 1</label>
            @if(isset($bita))
            <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($bita->evidencia1) }}" alt="">
            @endif
            <input type="file" name="evidencia11"  class="form-control">
        </div>
    </div>

    <div class="col-md-4"> 
        <div class="form-group">
            <label>Evidencia 2</label>
            @if(isset($bita))
            <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($bita->evidencia2) }}" alt="">
            @endif
            <input type="file" name="evidencia12"  class="form-control">
        </div>
    </div>

    <div class="col-md-4"> 
        <div class="form-group">
            <label>Evidencia 3</label>
            @if(isset($bita))
            <img style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded" src="{{ Storage::url($bita->evidencia3) }}" alt="">
            @endif
            <input type="file" name="evidencia13"  class="form-control">
        </div>
    </div>

<div class="col-md-4"> 
        <div class="form-group">
            <label>Destino</label>
            <input type="text" name="destino" value="@if(isset($bita)){{ $bita->destino }}@else{{ old('destino') }} @endif" class="form-control"
               placeholder="Destino"  >
        </div>
        @error('destino')
            <span style="color:crimson;">
                {{$message}}
            </span>
        @enderror
    </div>


  <div class="col-md-4"> 
        <div class="form-group">
            <label>Kilometraje</label>
            <input type="text" name="km"  onKeyPress="return valida(event)"  value="@if(isset($bita)){{ $bita->km }}@else{{ old('km') }} @endif" class="form-control"
               placeholder="Kilometraje"  >
        </div>
        @error('km')
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
                   @if(isset($bita))
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
                  <th>Fecha</th>
                  <th>No. Unidad</th>
                  <th>Marca</th>
                  <th>Color</th>
                  <th>Año</th>
                  <th>Placas</th>
                  <th>Operador</th>
                  <th>Destino</th>
                  <th>KM</th>
                  <th>Acciones</th>
                    @php
                $user = auth()->user();
            if($user->tipo==1){
                @endphp
                    <th>Eliminar</th>  
                    @php
            }
                @endphp     
                </tr>
                </thead>
                <tbody>
               @foreach ($bitacoras as $bitacora)
                <tr>
                    <td>{{ $bitacora->fecha_reg }}</td>
                    <td>{{ $unidades->no_economico }}</td>
                    <td>{{ $unidades->marca }}</td>
                    <td>{{ $unidades->color }}</td>
                    <td>{{ $unidades->anio }}</td>
                    <td>{{ $unidades->placas }}</td>
                    <td>
                        @foreach ($operadores as $operador)
                            @if ($operador->id == $bitacora->operador)
                                {{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $bitacora->destino }}</td>
                    <td>{{ $bitacora->km }}</td>
                    <td>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEvid{{ $bitacora->id }}">
<i class="fa-solid fa-car-tunnel"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalEvid{{ $bitacora->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Evidencias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">
        
      <div class="col-md-12"> 
        <h5><strong>Actividad:</strong> {{ $bitacora->actividad }}</h5>
</div>
<div class="col-md-4"> 
            <img style="width: 100%;" src="{{ Storage::url($bitacora->evidencia1) }}" alt="">
    </div>

    <div class="col-md-4"> 
            <img style="width: 100%;" src="{{ Storage::url($bitacora->evidencia2) }}" alt="">
    </div>

    <div class="col-md-4"> 
            <img style="width: 100%; " src="{{ Storage::url($bitacora->evidencia3) }}" alt="">
    </div>
        
    
    </div>


      <div class="modal-footer">
      
      </div>

    
    </div>
  </div>
</div>


                    </td>
        

                </td>
                @php
                $user = auth()->user();
            if($user->tipo==1){
                @endphp
     <td>
      <form class="delete-form" action="{{ route('bitacora.destroyBitacora', $unidades->id) }}" method="post">
                @csrf
                @method('DELETE')
               <input type="hidden" name="unidad" value="{{ $unidades->id }}"  >
                <input type="hidden" name="bitacora" value="{{ $bitacora->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
                
                @php
                } 
                @endphp
            </tr>
                @endforeach
                </tbody>
               
              </table>
</x-adminlte-card>


<?php /*


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

*/ ?>
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