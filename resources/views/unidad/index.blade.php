@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Padron</h1>
@stop

@section('content')
<div class="col-md-12 row mt-1" >
<div class="col-md-3" /><a class="btn btn-primary" href="{{ route('unidad.create') }}">Nueva Unidad</a></div>


</div>

  
<div class="col-md-12 row" >
&nbsp;
</div>
<div class="col-md-12 row" >



    @foreach($unidades as $unidad)

<div class="col-md-3">
          <div class="card card-primary">
             <div class="card-heart p-0" style="height:150px;">
<a href="{{ route('unidad.show', $unidad->id) }}"><img src="{{ Storage::url($unidad->imagen) }}"  style="object-fit: cover; width:100%; height:100%;"></a>
</div>
            <div class="card-body" style="background: #eee;">

            <p>
              {{ $unidad->modelo }}
                <br>
              No. Económico: {{ $unidad->no_economico }}
              <br>
              @foreach($areas as $area)
               @if ($area->id == $unidad->area)

               @foreach($dependencias as $dependencia)
               @if ($dependencia->id == $area->dependencia_id)
              {{  $dependencia->dependencia }}
            @endif
            @endforeach

            @endif
            @endforeach
              <br>
               {{ $unidad->marca }} {{ $unidad->color }}
               <br>
               Placas: {{ $unidad->placas }}
</p>
</div>
 <div class="card-footer">
    <div class="col-md-12" style="padding: 1px; text-align: center;">
    
    <a href="{{ route('unidad.show', $unidad->id) }}" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></a>
     <a href="{{ route('unidad.edit', $unidad->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
     <a href="{{ route('unidad.combustible', $unidad->id) }}" class="btn btn-primary"><i class="fa-solid fa-gas-pump"></i></a>
      <a href="{{ route('unidad.incidente', $unidad->id) }}" class="btn bg-purple"><i class="fa-solid fa-car-burst"></i></a>
      <a href="{{ route('unidad.imagenes', $unidad->id) }}" class="btn bg-dark"><i class="fa-solid fa-images"></i></a>
</div>

<div class="col-md-12" style="padding: 1px; text-align: center;">
      <a href="{{ route('unidad.documentos', $unidad->id) }}" class="btn bg-pink"><i class="fa-solid fa-folder-open"></i></a>
      <a href="{{ route('unidad.estatus', $unidad->id) }}" class="btn btn-default"><i class="fa-solid fa-bars-progress"></i></a>
<a href="{{ route('unidad.operadores', $unidad->id) }}" class="btn btn-info"><i class="fa-solid fa-id-card"></i></a>
      
</div>

    </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>


  

    @endforeach



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