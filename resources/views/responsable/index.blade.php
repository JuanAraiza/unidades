@extends('adminlte::page')

@section('title', 'AVIZOR')

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
            <th>Dependencia</th>
            <th>Area</th>
            <th>Puesto</th>
            <th>No. Economicos</th>
            <th></th>
            <th></th>
        </thead>
        @foreach($responsables as $responsable)
        <tr>
            <td>{{ $responsable->nombre }} {{ $responsable->paterno }} {{ $responsable->materno }}</td>
            <td> 
             @foreach($dependencias as $dependencia)   
             @if($dependencia->id == $responsable->dependencia) 
            {{ $dependencia->dependencia }}
            @endif
        @endforeach
        </td>
            <td> 
             @foreach($areas as $area)   
             @if($area->id == $responsable->area_id) 
            {{ $area->area }}
            @endif
        @endforeach
        </td>
        <td>{{ $responsable->puesto }}</td>
        <td style="text-align: center;">
                         

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEco{{ $responsable->id }}">
<i class="fa-solid fa-car"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalEco{{ $responsable->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">No. Ecnomicos: <strong>{{ $responsable->nombre }} {{ $responsable->paterno }} {{ $responsable->materno }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">
       


 @foreach($ecos as $eco)
@if($eco->responsable == $responsable->id)
    <div class="col-md-12 row">
        <div class="col-md-6">
            <p>{{ $eco->no_economico }}</p>
        </div>
        
        <div class="col-md-2">
            <form class="delete-form" action="{{ route('responsable.destroyEco') }}" method="post">
                @csrf
              <input type="hidden" name="eco_id" value="{{ $eco->id }}"  >
            
                <input name="deshabilitado" value="1" type="hidden">
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
            </form>                   
        </div>
    </div>
@endif
 @endforeach

<hr style="width: 100%;">
      <form action="{{ route('responsable.addEco', $responsable->id) }}" class="col-md-12" method="POST">
            @csrf
        <div class="row col-md-12">
            <input type="hidden" name="responsable_id" value="{{ $responsable->id }}"  >
            <div class="col-md-6"> 
                <div class="form-group">
                    <label>No. Economico</label>
                    <input class="form-control" type="text" name="no_economicoc"  >
                </div>
            </div>
            
            <div class="col-md-6"> 
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-success form-control" value="Guardar No. Economico">
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