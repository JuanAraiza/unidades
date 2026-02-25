@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Comprometidos</h1>
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

<div class="col-md-2"> 
        <div class="form-group">
            <label>Dependencia</label>
            <input type="text" name="fdependencia" id="fdependencia" class="form-control" readonly  >
        </div>
    </div>

    <div class="col-md-2"> 
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
            <label>Folio Fiscal</label>
            <input type="text" name="folio_fiscal" value="{{ old('folio_fiscal') }}" class="form-control"
               placeholder="Folio Fiscal"  >
        </div>
    </div>


   <div class="col-md-2"> 
        <div class="form-group">
            <label>Costo Total</label>
            <input type="text" name="costo_t" id="costo_t" class="form-control" readonly  >
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


<div class="col-md-12 " >
<hr style="border: 1px solid #333;  width:100%;">
</div>

</div>



</form>
<table id="tablacomprometidos"  class="display">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                <th>Unidad</th>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Litros</th>
                  <th>Costo</th>
                  <th>Combustible</th>
                  <th>Proveedor</th>
                  
                  <th>Justificación</th>
                  <th>Destino</th>
                  
                  <th>Kilometraje</th>
                  <th>Área</th>
                  <th>Dependencia</th>
                  <th>Folio SAT</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($vales as $vale)
                <tr>
                   <td>{{ $vale->id }}</td> 
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
                     <td>$ {{ number_format($vale->costo,2) }}</td>
                     <td>{{ $vale->tipo_com == 1 ? 'Gas 1' : ($vale->tipo_com == 2 ? 'Gas 2' : ($vale->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}</td>
                    <td>
                        @foreach($proveedores as $proveedor)
                            {{ $vale->proveedor == $proveedor->id ? $proveedor->gasolinera  : '' }}
                        @endforeach
                    </td>
                    <td>{{ $vale->justificacion }}</td>
                    <td>{{ $vale->destino }}</td>
                    
                    <td>{{ $vale->km }}</td>
                    <td> 
                        @foreach($areas as $area)
                        {{ $vale->area == $area->id ? $area->area : '' }}
    @endforeach
                         </td>
                    <td> 
                        @foreach($dependencias as $dependencia)
                        {{ $vale->dependencia == $dependencia->id ? $dependencia->dependencia : '' }}
    @endforeach
                         </td>
                    <td>{{ $vale->folio_sat }}</td>
                    
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
  document.getElementById('selectedRows').value = '';
  document.getElementById('selectedRowsFolios').value = '';
  document.getElementById('costo_t').value = '0.0';

var table = $('#tablacomprometidos').DataTable({
        order: [
            [0, 'desc'],
        
        ],
        "scrollX": true,
        //"scrollY": "50vh",
        //Esto sirve que se auto ajuste la tabla al aplicar un filtro
         "scrollCollapse": true,
     
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
        
        initComplete: function() {
            this.api().columns([7,8,13]).every( function () {
            //this.api().columns().every(function() {
                var column = this;

                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.header()))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                         
                            column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                            var valorcol=$(this).val();
                            console.log('Valor seleccionado:', valorcol);
                            var indexcol=$(column.index());
                            console.log('Columna:', indexcol[0]);
                            let sindexcol = indexcol[0];

                        switch(sindexcol){
                            case 7:
                                document.getElementById('ftipogas').value= valorcol ;
                            break;
                            case 8:
                                document.getElementById('fproveedor').value= valorcol ;
                            break;
                            case 13:
                                document.getElementById('fdependencia').value= valorcol ;
                            break;

                        }

                        
                    });



                    //Este codigo sirve para que no se active el ordenamiento junto con el filtro
                $(select).click(function(e) {
                    e.stopPropagation();
                });
                //===================

                column.data().unique().sort().each(function(d, j) {
                    // select.append('<option value="' + d + '">' + d + '</option>')
                        
                        select.append('<option value="' + d + '">' + d + '</option>')
                    
                });

                

            });


            
        },
        "aoColumnDefs": [
         { "bSearchable": false, "aTargets": [ 1 ] }
       ] 
      
    });
    //********Esta bendita linea hace la magia, adjusta el header de la tabla con el body 
    table.columns.adjust();



table.on('click', 'tbody tr', function (e) {
    e.currentTarget.classList.toggle('selected');
    document.getElementById('selectedRows').value = '0';
    document.getElementById('selectedRowsFolios').value = '';
    document.getElementById('costo_t').value = '0.0';
    var costo = 0.0;
  
    const selectedData = table.rows('.selected').data();
    for (let i = 0; i < selectedData.length; i++) {
        document.getElementById('selectedRows').value += ','+selectedData[i][0];
        document.getElementById('selectedRowsFolios').value += selectedData[i][3]+',';
        var dcosto='';
        dcosto = selectedData[i][6].replace("$", "");
        dcosto = dcosto.replace(",", "");
        dcosto = dcosto.replace(" ", "");
        
        costo = costo + parseFloat(dcosto);
    };
    document.getElementById('selectedRows').value += ',0';
    
    document.getElementById('costo_t').value = Math.round(costo * 100) / 100;
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