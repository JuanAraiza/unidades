

@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Proveedores</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('proveedor.create') }}">Nuevo Proveedor</a></div>


</div>

    <div class="row mt-1">
<div class="col-md-2" />&nbsp;</div>
<div class="card col-md-8" />

<div class="card-body">

    <table class="table">
        <thead>
            <th>Gasolinera</th>
            <th>RFC</th>
            <th>Razon Social</th>
            <th>Contraseña para<br>Cargar</th>
            <th></th>
            <th></th>
        </thead>
        @foreach($proveedores as $proveedor)
        <tr>
            <td>{{ $proveedor->gasolinera }}</td>
           <td>{{ $proveedor->rfc }}</td>
        <td>{{ $proveedor->razon_social }}</td>
        <td>{{ $proveedor->contra }}</td>
            <td><a href="{{ route('proveedor.edit', $proveedor->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            <td><form class="delete-form" action="{{ route('proveedor.destroy', $proveedor->id) }}" method="post">
                @csrf
                @method('DELETE')
               
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
        </tr>
        @endforeach
    </table>
</div>



</div>
<div class="col-md-2" />&nbsp;</div>
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