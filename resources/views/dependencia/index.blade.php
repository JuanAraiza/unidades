@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Dependencias</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('dependencia.create') }}">Nueva Dependencia</a></div>


</div>

    <div class="row mt-1">
<div class="col-md-2" />&nbsp;</div>
<div class="card col-md-8" />

<div class="card-body">

    <table class="table">
        <thead>
            <th>
Dependencia
            </th>
            <th>Editar</th>
            <th>Eliminar</th>
             <th>Areas</th>
        </thead>
        @foreach($dependencias as $dependencia)
        <tr>
            <td> {{ $dependencia->dependencia }}</td>
            <td><a href="{{ route('dependencia.edit', $dependencia->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            <td><form class="delete-form" action="{{ route('dependencia.destroy', $dependencia->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="dependencia" value="{{ $dependencia->dependencia }}"  >
                <input name="deshabilitado" value="1" type="hidden">
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>

<td>
                         

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAreas{{ $dependencia->id }}">
 <i class="fa-solid fa-building-columns"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalAreas{{ $dependencia->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dependencia: <strong>{{ $dependencia->dependencia }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">
        <h4>Areas</h4>
<hr style="width: 100%;">

 @foreach($areas as $area)
@if($area->dependencia_id == $dependencia->id)
    <div class="col-md-12 row">
        <div class="col-md-8">
            <p>{{ $area->area }}</p>
        </div>
        <div class="col-md-4">
            <form class="delete-form" action="{{ route('dependencia.destroyArea') }}" method="post">
                @csrf
              <input type="hidden" name="area_id" value="{{ $area->id }}"  >
                <input type="hidden" name="dependenci_id" value="{{ $dependencia->id }}"  >
                <input type="hidden" name="area" value="{{ $area->area }}"  >
                <input name="deshabilitado" value="1" type="hidden">
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
            </form>                   
        </div>
    </div>
@endif
 @endforeach

<hr style="width: 100%;">
      <form action="{{ route('dependencia.addArea', $dependencia->id) }}" class="col-md-12" method="POST">
            @csrf
        <div class="row col-md-12">
            <input type="hidden" name="dependencia_id" value="{{ $dependencia->id }}"  >
            <div class="col-md-8"> 
                <div class="form-group">
                    <label>Nueva Area</label>
                    <input class="form-control" type="text" name="area"  >
                </div>
            </div>

            <div class="col-md-4"> 
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-success form-control" value="Guardar Area">
                </div>
            </div>

        </div>
        </form>
      </div>
      <div class="modal-footer">
      
      </div>

    
    </div>
  </div>
</div>


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