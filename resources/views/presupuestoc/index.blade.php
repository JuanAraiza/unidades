@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
<div class="row col-md-12" />
    <div class="col-md-3" />
        <h1>Presupuesto Combustible</h1>
    </div>
    <div class="col-md-6" />
        
    </div>
    <div class="col-md-3" style="text-align: right;" />
       <a class="btn btn-primary" href="{{ route('presupuestoc.create') }}">Nuevo Registro</a>
    </div>
</div>
@stop

@section('content')


    <div class="row mt-1">

<div class="card col-md-12" />

<div class="card-body">

    <table class="table" style="font-size: 12px;">
        <thead>
            <th>Ejercicio</th>
            <th>Fondo</th>
            <th>Programa</th>
            <th>Centro Gestor</th>
            <th>Nombre C.G.</th>
            <th>Área Funcional</th>
            <th>Partida</th>
            <th>Partida Denominación</th>
            <th>Asignado</th>
            <th>Disponible para compra</th>
            <th>Comprometido</th>
            <th>Finalizado</th>
            <th>Tramite P.</th>
            <th></th>
        </thead>
        @foreach($presupuestos as $presupuesto)
        <tr>
            <td>{{ $presupuesto->ejercicio }}</td>
            <td>{{ $presupuesto->fondo }}</td>
            <td>{{ $presupuesto->programa }}</td>
            <td>{{ $presupuesto->centro_g }}</td>
            <td>{{ $presupuesto->nombre_cg }}</td>
            <td>{{ $presupuesto->area_fun }}</td>
            <td>{{ $presupuesto->partida }}</td>
            <td>{{ $presupuesto->partida_den }}</td>
            <td>$ {{ number_format($presupuesto->asignado, 2, '.', ',') }}</td>
            <td>$ {{ number_format($presupuesto->disponible, 2, '.', ',') }}</td>
            <td> @php
                        $comprometido = \DB::table('combustibles')->selectRaw('sum(costo) as total')->where('dependencia', $presupuesto->dependencia )->where('estatus',3)->first();
                    @endphp
                $ {{ number_format($comprometido->total ?? 0, 2, '.', ',') }}
                </td>

                <td> @php
                        $formalizados = DB::select('select sum(costo_t) as total from factura_gas where dependencia='.$presupuesto->dependencia.' and id not in(select tramite from archivos_gas where tipo=4)');
        
                    @endphp
                     @foreach($formalizados as $formalizado)
                $ {{ number_format($formalizado->total ?? 0, 2, '.', ',') }}
                @endforeach
                </td>

                <td> @php
                        $tramites = DB::select('select sum(costo_t) as total from factura_gas where dependencia='.$presupuesto->dependencia.' and id in(select tramite from archivos_gas where tipo=4)');
                    @endphp
                    @foreach($tramites as $tramite)
                $ {{ number_format($tramite->total ?? 0, 2, '.', ',') }}
                @endforeach
                </td>
            <td><a href="{{ route('presupuestoc.edit', $presupuesto->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
        </tr>
        @endforeach
    </table>
</div>



</div>

</div>


   <!-- <p>Welcome to this beautiful admin panel. bla bla</p>-->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
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
    </script>




@endpush