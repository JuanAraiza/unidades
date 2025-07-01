@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Tipos de Vehículo</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('tipov.create') }}">Nuevo Tipo</a></div>


</div>

    <div class="row mt-1">
<div class="col-md-2" />&nbsp;</div>
<div class="card col-md-8" />

<div class="card-body">

    <table class="table">
        <thead>
            <th>
Tipo de Vehiculo
            </th>
            <th></th>
            <th></th>
        </thead>
        @foreach($tipovs as $tipov)
        <tr>
            <td> {{ $tipov->tipo }}</td>
            <td><a href="{{ route('tipov.edit', $tipov->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            <td><form  class="delete-form" action="{{ route('tipov.destroy', $tipov->id) }}" method="post">
                
                @csrf
                @method('PUT')
                <input type="hidden" name="tipo" value="{{ $tipov->tipo }}"  >
                <input name="deshabilitado" value="1" type="hidden">
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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE packagetipo!"); </script>
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