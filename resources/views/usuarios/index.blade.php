@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('usuarios.create') }}">Nuevo Usuario</a></div>


</div>

    <div class="row mt-1">
<div class="col-md-2" />&nbsp;</div>
<div class="card col-md-8" />

<div class="card-body">

    <table class="table">
        <thead>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Dependencia</th>
            <th></th>
            <th></th>
        </thead>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }} </td>
            <td>{{ $usuario->email }} </td>
            <td>
            @if($usuario->tipo == 1)
            Administrador
            @elseif($usuario->tipo == 2)
            Dependencia
            @elseif($usuario->tipo == 3)
            Gasolinera
            @else
            Invitado
            @endif
            
        </td>
            <td> 
             @foreach($dependencias as $dependencia)   
             @if($dependencia->id == $usuario->dependencia) 
            {{ $dependencia->dependencia }}
            @endif
        @endforeach
        </td>
        
      
            <td><a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning"><span  class="fas fa-pencil"></span></a></td>
            <td><form class="delete-form" action="{{ route('usuarios.destroy', $usuario->id) }}" method="post">
                @csrf
                @method('PUT')
                <input name="deshabilitado" value="1" type="hidden">
                <input type="hidden" name="password" value="{{ $usuario->password }}" >
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