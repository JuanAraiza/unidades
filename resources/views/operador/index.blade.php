@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Operadores</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('operador.create') }}">Nuevo Operador</a></div>


</div>

    <div class="row mt-1">

<div class="card col-md-12" />

<div class="card-body">

    <table class="table">
        <thead>
            <th></th>
            <th>Operador</th>
            <th>Dependencia</th>
            <th>Area</th>
            <th>Puesto</th>
            <th>Telefono</th>
            <th>Domicilio</th>
            <th>Licencia</th>
            <th>Vigencia</th> 
            <th>Contactos</th>  
            <th></th>
            <th></th>
        </thead>
        @foreach($operadores as $operador)
        <tr>
             <td>
             <div class="card-heart p-0" style="height:150px; width: 150px;">
                            <img  id="imgPreview"  style="object-fit: cover;width: 100%; height:100%;" class="img-fluid object-fit-cover border rounded"  src="{{ Storage::url($operador->foto) }}" alt="">
</div>   
             </td>
            <td>{{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}</td>
            <td> 
             @foreach($dependencias as $dependencia)   
             @if($dependencia->id == $operador->dependencia) 
            {{ $dependencia->dependencia }}
            @endif
        @endforeach
        </td>
            <td> 
             @foreach($areas as $area)   
             @if($area->id == $operador->area) 
            {{ $area->area }}
            @endif
        @endforeach
        </td>
        <td>{{ $operador->puesto }}</td>
        <td>{{ $operador->telefono }}</td>
        <td>{{ $operador->direccion }}</td>
        <td> <a href="{{ Storage::url($operador->licencia) }}" target="_blank">Ver Licencia</a></td>
        <td>{{ $operador->vigencia }}</td>
        <td style="text-align: center;">
                         

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalContactos{{ $operador->id }}">
 <i class="fa-solid fa-address-book"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalContactos{{ $operador->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contactos: <strong>{{ $operador->nombre }} {{ $operador->paterno }} {{ $operador->materno }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">
       


 @foreach($contactos as $contacto)
@if($contacto->operador == $operador->id)
    <div class="col-md-12 row">
        <div class="col-md-3">
            <p>{{ $contacto->nombre }}</p>
        </div>
        <div class="col-md-2">
            <p>{{ $contacto->telefono }}</p>
        </div>
         <div class="col-md-3">
            <p>{{ $contacto->direccion }}</p>
        </div>
         <div class="col-md-2">
            <p>{{ $contacto->parentesco }}</p>
        </div>
        <div class="col-md-2">
            <form class="delete-form" action="{{ route('operador.destroyContacto') }}" method="post">
                @csrf
              <input type="hidden" name="contacto_id" value="{{ $contacto->id }}"  >
            
                <input name="deshabilitado" value="1" type="hidden">
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
            </form>                   
        </div>
    </div>
@endif
 @endforeach

<hr style="width: 100%;">
      <form action="{{ route('operador.addContacto', $operador->id) }}" class="col-md-12" method="POST">
            @csrf
        <div class="row col-md-12">
            <input type="hidden" name="operador_id" value="{{ $operador->id }}"  >
            <div class="col-md-3"> 
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" name="nombrec"  >
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="form-group">
                    <label>Teléfono</label>
                    <input class="form-control" type="text" name="telefonoc"  >
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="form-group">
                    <label>Dirección</label>
                    <input class="form-control" type="text" name="direccionc"  >
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="form-group">
                    <label>Parentesco</label>
                    <input class="form-control" type="text" name="parentescoc"  >
                </div>
            </div>

            <div class="col-md-3"> 
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-success form-control" value="Guardar Contacto">
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


            <td><a href="{{ route('operador.edit', $operador->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            <td><form class="delete-form" action="{{ route('operador.destroy', $operador->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="nombre" value="{{ $operador->nombre }}"  >
                <input type="hidden" name="paterno" value="{{ $operador->paterno }}"  >
                <input type="hidden" name="materno" value="{{ $operador->materno }}"  >
                <input type="hidden" name="puesto" value="{{ $operador->paterno }}"  >
                <input name="deshabilitado" value="1" type="hidden">
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</td>
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