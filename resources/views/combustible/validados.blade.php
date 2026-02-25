@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Aceptados</h1>
@stop

@section('content')

<x-adminlte-card theme="primary" theme-mode="outline">

<div class="row col-md-12 ">
    <div class="col-md-4">    
        <a href="{{ route('combustible.index') }}" class="btn btn-primary btn-block">Solicitados</a>
    </div>
     <div class="col-md-4">    
        <a href="{{ route('combustible.validados') }}" class="btn btn-info btn-block">Aceptados</a>
    </div>
     <div class="col-md-4">    
        <a href="{{ route('combustible.cancelados') }}" class="btn btn-danger btn-block">Cancelados</a>
    </div>
     
</div>
<div class="row col-md-12 ">&nbsp; </div>
<div class="row col-md-12 ">
  <div class="col-md-4">    
        <a href="{{ route('combustible.comprometidos') }}" class="btn btn-success btn-block">Comprometidos</a>
    </div>
    <div class="col-md-4">    
        <a href="{{ route('combustible.formalizado') }}" class="btn bg-purple btn-block">Formalizado</a>
    </div>
     <div class="col-md-4">    
        <a href="{{ route('combustible.completados') }}" class="btn btn-warning btn-block">Tramite Completado para Pago</a>
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
                    <th></th>
                <th>Unidad</th>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Litros</th>
                  <th>Operador</th>
                  <th>Justificación</th>
                  <th>Destino</th>
                  <th>Tipo Combustible</th>
                  <th>Proveedor</th>
                  <th>Kilometraje</th>
                  <th>Área</th>
                  <th></th> 
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
                        @if($vale->unidad == $unidad->id)
                        <div class="card-heart p-0" style="height:150px; width: 250px;">
                            <img  id="imgPreview"  style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded"  src="{{ $vale->unidad == $unidad->id ? Storage::url($unidad->imagen) : '' }}" alt="">
                        </div>
                        @endif 
                        @endforeach  
                  
                 </td>
                    <td>
                        @foreach($unidades as $unidad)
                            {{ $vale->unidad == $unidad->id ? $unidad->marca  : '' }}
                            {{ $vale->unidad == $unidad->id ? $unidad->modelo  : '' }}
                            {{ $vale->unidad == $unidad->id ? $unidad->color  : '' }}
                            {{ $vale->unidad == $unidad->id ? $unidad->no_economico : '' }}
                        @endforeach
                    </td>
                    <td>{{ $vale->folio }}</td>
                    <td>{{ $vale->updated_at->format('Y/m/d') }}</td>
                    <td>{{ $vale->litros }}</td>
                    <td>
                        @foreach($operadores as $operador)
                            {{ $vale->operador == $operador->id ? $operador->nombre . ' ' . $operador->paterno . ' ' . $operador->materno : '' }}
                        @endforeach
                    </td>
                    <td>{{ $vale->justificacion }}</td>
                    <td>{{ $vale->destino }}</td>
                    <td>{{ $vale->tipo_com == 1 ? 'Gas 1' : ($vale->tipo_com == 2 ? 'Gas 2' : ($vale->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}</td>
                    <td> 
                        @foreach($proveedores as $proveedor)
                        {{ $vale->proveedor == $proveedor->id ? $proveedor->gasolinera : '' }}
    @endforeach
                         </td>
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
      <form action="{{ route('combustible.cancelarValidados', $vale->id) }}" method="POST">
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


                      <td>


                        <a type="button" class="btn btn-info" href="{{ route('combustible.imvale', $vale->id) }}" target="_blank">
<i class="fa-solid fa-qrcode"></i>
</a>
</td>
 <td>


                        <a type="button" class="btn btn-warning" href="{{ route('combustible.printimvale', $vale->id) }}" target="_blank">
<i class="fa-solid fa-print"></i>
</a>
</td>


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

var table = $('#tablaincidentes').DataTable({
    "scrollX": true,
        //Esto sirve que se auto ajuste la tabla al aplicar un filtro
    "scrollCollapse": true,
    order: [[ 2, 'desc' ]],
    columnDefs: [{ type: 'date', targets: 2 }],
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

table.columns.adjust();
      </script>


@stop

@push('js')
   
    
@endpush