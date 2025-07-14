@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Responsables</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('responsable.create') }}">Nuevo Responsable</a></div>


</div>

    <div class="row mt-1">
<div class="col-md-2" />&nbsp;</div>
<div class="card col-md-8" />

<div class="card-body">

    <table class="table">
        <thead>
            <th>Responsable</th>
            <th>Area</th>
            <th>Puesto</th>
            <th></th>
            <th></th>
        </thead>
        @foreach($responsables as $responsable)
        <tr>
            <td>{{ $responsable->nombre }} {{ $responsable->paterno }} {{ $responsable->materno }}</td>
            <td> 
             @foreach($areas as $area)   
             @if($area->id == $responsable->area_id) 
            {{ $area->area }}
            @endif
        @endforeach
        </td>
        <td>{{ $responsable->puesto }}</td>
            <td><a href="{{ route('responsable.edit', $responsable->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            <td><form class="delete-form" action="{{ route('responsable.destroy', $responsable->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="nombre" value="{{ $responsable->nombre }}"  >
                <input type="hidden" name="paterno" value="{{ $responsable->paterno }}"  >
                <input type="hidden" name="materno" value="{{ $responsable->materno }}"  >
                <input type="hidden" name="puesto" value="{{ $responsable->paterno }}"  >
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