@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Precio Gasolina</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('preciogas.create') }}">Nuevo Precio</a></div>


</div>

    <div class="row mt-1">
<div class="col-md-2" />&nbsp;</div>
<div class="card col-md-8" />

<div class="card-body">

    <table class="table">
        <thead>
            <th>GAS 1</th>
            <th>GAS 2</th>
            <th>DIESEL</th>
            <th>GAS LP</th>
            <th>GASOLINERA</th>
            <th>FECHA</th>
            <th>HORA</th>
            <th></th>
        </thead>
        @foreach($precios as $precio)
        <tr>
            <td>$ {{ number_format($precio->gas1,2)}}</td>
            <td>$ {{ number_format($precio->gas2,2) }}</td>
            <td>$ {{ number_format($precio->diesel,2) }}</td>
            <td>$ {{ number_format($precio->lp,2) }}</td>
            <td> 
             @foreach($proveedores as $proveedor)   
             @if($proveedor->id == $precio->proveedor) 
            {{ $proveedor->gasolinera }}
            @endif
        @endforeach
        </td>
            <td>{{ substr($precio->fecha,8,2).'-'.substr($precio->fecha,5,2).'-'.substr($precio->fecha,0,4) }}</td>
            <td>{{ $precio->hora }}</td>
            
            <td><a href="{{ route('preciogas.edit', $precio->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            
        </tr>
        @endforeach
    </table>
</div>



</div>
<div class="col-md-2">&nbsp;</div>
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