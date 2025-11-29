@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Formalizados</h1>
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
<?php /*
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
*/ ?>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>


<x-adminlte-card theme="primary" theme-mode="outline">



<form action="{{ route('combustible.crearFactura') }}" method="POST">
            @csrf
<div class="row">

<div class="col-md-3"> 
        <div class="form-group">
            <label>Dependencia</label>
            <input type="text" name="fdependencia" id="fdependencia" class="form-control" readonly  >
        </div>
    </div>

    <div class="col-md-3"> 
        <div class="form-group">
            <label>Proveedor</label>
            <input type="text" name="fproveedor" id="fproveedor" class="form-control" readonly  >
        </div>
    </div>

    <div class="col-md-2"> 
        <div class="form-group">
            <label>Tipo Gasolina</label>
            <input type="text" name="ftipogas" id="ftipogas" class="form-control" readonly  >
        </div>
    </div>



    <div class="col-md-2"> 
        <div class="form-group">
            <label>No. Factura</label>
            <input type="text" name="factura" value="{{ old('factura') }}" class="form-control"
               placeholder="00000"  >
        </div>
    </div>


    <div class="col-md-2"> 
        <div class="form-group">
            <label>Otros Datos</label>
            <input type="text" name="otros_datos" value="{{ old('otros_datos') }}" class="form-control"
               placeholder="Otro Dato"  >
        </div>
    </div>



<div class="col-md-12"> 
        <div class="form-group">
            <label>Folios</label>
            <textarea id="selectedRowsFolios" name="folios2" class="form-control" rows="2" cols="50" readonly></textarea>
        </div>
</div>

<input type="hidden" id="selectedRows" name="folios" class="form-control" />


<div class="col-md-12"> 
        <div class="form-group">
        
        <button type=submit class="btn btn-primary form-control">
                   <span class="fa fa-save"></span>&nbsp;
                    Guardar Factura
                </button>
        </div>
    </div>



<table id="tablaformailzados"  class="display table">
    <thead>
        <tr>
            <th>Factura</th>
            <th>No. Tramite</th>
            <th>Fecha</th>
            <th>Gasolinera</th>
            <th>Dependencia</th>
            <th>Costo</th>
            <th>Folios</th>
            
            
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($formalizados as $formalizado)
            <tr>
                <td>{{ $formalizado->factura }}</td>
                <td>{{ $formalizado->tramite }}</td>
                <td>{{ substr($formalizado->fecha,0,10) }}</td>
                <td>
                     @foreach($proveedores as $proveedor)
                        {{ $formalizado->gasolinera == $proveedor->id ? $proveedor->gasolinera : '' }}
                    @endforeach
                </td>
                
                <td> 
                    @foreach($dependencias as $dependencia)
                        {{ $formalizado->dependencia == $dependencia->id ? $dependencia->dependencia : '' }}
                    @endforeach
                </td>
  <td>
                    @php
                        $vls = explode(",", $formalizado->folios);
                        $costots = \DB::table('combustibles')->selectRaw('SUM(costo) as costo')->whereIn('id', $vls)->get();
                    @endphp


                    @foreach ($costots as $costot)
                        $ {{ number_format($costot->costo,2) }}
                    @endforeach
                </td>


                <td>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalVerFactu{{ $formalizado->id }}">
 VER FOLIOS
</button>

<!-- Modal -->
<div class="modal fade" id="modalVerFactu{{ $formalizado->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Folios Tramite: {{ $formalizado->tramite }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body row">
        <h4>{{ $formalizado->folios2 }}</h4>
      </div>
      <div class="modal-footer">
       
      </div>

      
    </div>
  </div>
</div>



                </td>
              

<!--
<td>
  <a href="{{ route('combustible.descargarWord', $formalizado->id) }}" target="_blank" class="btn bg-blue"><i class="fa-solid fa-file-word"></i></a>
</td> -->

<!-- tabla eliminar -->
  <td><form class="delete-form" action="{{ route('combustible.destroyFactura', $formalizado->id) }}" method="post">
                @csrf
                @method('DELETE')
               
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
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

var table = $('#tablaformailzados').DataTable({
    "scrollX": true,
         "scrollCollapse": true,
     order: [[ 2, 'desc' ]],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        
     
      
    });
    //********Esta bendita linea hace la magia, adjusta el header de la tabla con el body 
    table.columns.adjust();


  document.getElementById('selectedRows').value = '';
  document.getElementById('selectedRowsFolios').value = '';


table.on('click', 'tbody tr', function (e) {
    e.currentTarget.classList.toggle('selected');
    document.getElementById('selectedRows').value = '0';
    document.getElementById('selectedRowsFolios').value = '';
    const selectedData = table.rows('.selected').data();
    for (let i = 0; i < selectedData.length; i++) {
        document.getElementById('selectedRows').value += ','+selectedData[i][0];
        document.getElementById('selectedRowsFolios').value += selectedData[i][2]+',';
    };
    document.getElementById('selectedRows').value += ',0';
        // alert(table.rows('.selected').data().length + ' row(s) selected');
 
    //alert('You clicked on '+table.row(this).data()[0]+'\'s row');

    //alert('You clicked on '+table.row(this).data()[1]+'\'s row');

     
});
 
document.querySelector('#button').addEventListener('click', function () {
    alert(table.rows('.selected').data().length + ' row(s) selected');
});


  
      </script>


@stop

@push('js')
   
    
@endpush