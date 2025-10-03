@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Solicitados</h1>
@stop

@section('content')

<x-adminlte-card theme="primary" theme-mode="outline">

<div class="row col-md-12 ">
    <div class="col-md-3">    
        <a href="{{ route('combustible.index') }}" class="btn btn-primary btn-block">Solicitados</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('combustible.validados') }}" class="btn btn-default btn-block">Validados</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('combustible.paracargar') }}" class="btn btn-info btn-block">Para Cargar</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('combustible.cargados') }}" class="btn btn-success btn-block">Gasolina Cargada</a>
    </div>
</div>
<div class="row col-md-12 ">&nbsp; </div>
<div class="row col-md-12 ">
    <div class="col-md-3">    
        <a href="{{ route('combustible.pagogas') }}" class="btn bg-purple btn-block">Pago Gasolina</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('combustible.cancelados') }}" class="btn btn-warning btn-block">Cancelados</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('combustible.oficios') }}" class="btn btn-danger btn-block">Oficios</a>
    </div>
     <div class="col-md-3">    
        <a href="{{ route('combustible.todos') }}" class="btn bg-navy btn-block">Todos</a>
    </div>
</div>

</x-adminlte-card>
<div class="col-md-12 row" >
&nbsp;
</div>


<x-adminlte-card theme="primary" theme-mode="outline">

<table id="tablaincidentes" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Unidad</th>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Litros</th>
                  <th>Operador</th>
                  <th>Justificación</th>
                  <th>Destino</th>
                  <th>Tipo Combustible</th>
                  <th>Kilometraje</th>
                  <th>Área</th>
                  <th></th> 
                  <th></th>
                  <th></th>  
                </tr>
                </thead>
                <tbody>
    @foreach ($vales as $vale)
                <tr>
                    <td>
                        @foreach($unidades as $unidad)
                            {{ $vale->unidad == $unidad->id ? $unidad->marca . ' ' . $unidad->modelo . ' ' . $unidad->color : '' }}
                        @endforeach
                    </td>
                    <td>{{ $vale->folio }}</td>
                    <td>{{ $vale->created_at->format('d/m/Y') }}</td>
                    <td>{{ $vale->litros }}</td>
                    <td>
                        @foreach($operadores as $operador)
                            {{ $vale->operador == $operador->id ? $operador->nombre . ' ' . $operador->paterno . ' ' . $operador->materno : '' }}
                        @endforeach
                    </td>
                    <td>{{ $vale->justificacion }}</td>
                    <td>{{ $vale->destino }}</td>
                    <td>{{ $vale->tipo_com == 1 ? 'Gas 1' : ($vale->tipo_com == 2 ? 'Gas 2' : ($vale->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}</td>
                    <td>{{ $vale->km }}</td>
                    <td> 
                        @foreach($areas as $area)
                        {{ $vale->area == $area->id ? $area->area : '' }}
    @endforeach
                         </td>
          
                         <td>
                         

<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalVerVale{{ $vale->id }}">
 <i class="fa-solid fa-search"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalVerVale{{ $vale->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Folio Vale: {{ $vale->folio }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body row">
        
        <div class="col-md-4">
            <div class="form-group">
            <strong>Unidad:</strong> <br>
            @foreach($unidades as $unidad)
                {{ $vale->unidad == $unidad->id ? $unidad->marca . ' ' . $unidad->modelo . ' ' . $unidad->color : '' }}
            @endforeach
</div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <strong>Folio:</strong> <br>
            {{ $vale->folio }}
</div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <strong>Fecha Solicitud:</strong> <br>
            {{ $vale->created_at->format('d/m/Y') }}
</div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <strong>Litros:</strong> <br>
            {{ $vale->litros }}
</div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <strong>Operador:</strong> <br>
            @foreach($operadores as $operador)
                {{ $vale->operador == $operador->id ? $operador->nombre . ' ' . $operador->paterno . ' ' . $operador->materno : '' }}
            @endforeach
</div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <strong>Justificación:</strong> <br>
            {{ $vale->justificacion }}
</div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <strong>Destino:</strong> <br>
            {{ $vale->destino }}
</div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <strong>Tipo Combustible:</strong> <br>
            {{ $vale->tipo_com == 1 ? 'Gas 1' : ($vale->tipo_com == 2 ? 'Gas 2' : ($vale->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}
</div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <strong>Kilometraje:</strong> <br>
            {{ $vale->km }}
</div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <strong>Área:</strong> <br>
                        @foreach($areas as $area)
                        {{ $vale->area == $area->id ? $area->area : '' }}
                @endforeach 
            </div>
</div>
        

      </div>
      <div class="modal-footer">
       
      </div>

      
    </div>
  </div>
</div>


                    </td>


                    <td>
                         

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalValiteVale{{ $vale->id }}">
 <i class="fa-solid fa-circle-check"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalValiteVale{{ $vale->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Folio Vale: {{ $vale->folio }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('combustible.validar', $vale->id) }}" method="POST">
            @csrf
            @method('PUT')
      <div class="modal-body row">
        

        
        <div class="col-md-6"> 
            <div class="form-group">
                <label>Vigencia</label>
                {{-- Minimal --}}
                <x-adminlte-select2 name="vigencia"  data-placeholder="Selecciona vigencia....">
                            <option value="2">2 horas</option>
                            <option value="4">4 horas</option>
                            <option value="24">24 horas</option>
                            <option value="48">48 horas</option>
                </x-adminlte-select2>
            </div>
        </div>

        <div class="col-md-6"> 
            <div class="form-group">
                <label>Proveedor</label>
                {{-- Minimal --}}
                <x-adminlte-select2 name="proveedor"  data-placeholder="Selecciona proveedor....">
                    @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->gasolinera }}</option>
                    @endforeach
                </x-adminlte-select2>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Validar">
      </div>

      </form>
    </div>
  </div>
</div>


                    </td>


                     <td>
                         

<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancelVale{{ $vale->id }}">
 <i class="fa-solid fa-circle-xmark"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalCancelVale{{ $vale->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancelar Folio Vale: {{ $vale->folio }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('combustible.cancelar', $vale->id) }}" method="POST">
            @csrf
            @method('PUT')
      <div class="modal-body row">
        

        
        <div class="col-md-12"> 
            <div class="form-group">
                <label>Motivo Cancelación</label>
                <x-adminlte-textarea name="mensajec" placeholder="Motivo..."/>
            </div>
        </div>

        

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-danger" value="Cancelar Vale">
      </div>

      </form>
    </div>
  </div>
</div>


                    </td>

<!--
                      <td>


                        <a type="button" class="btn btn-warning" href="{{ route('unidad.imvale', $vale->id) }}" target="_blank">
<i class="fa-solid fa-print"></i>
</a>
</td>
-->

                </tr>
                @endforeach
          </tbody>
</table>



</x-adminlte-card>





   <!-- <p>Welcome to this beautiful admin panel. bla bla</p>-->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
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
    </script>

    <script>
//$("#tablaRegistros").dataTable().fnDestroy();

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
   
    
@endpush