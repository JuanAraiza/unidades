@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <div class="col-md-12 row" >
    <div class="col-md-2">
<h1>Padron</h1>
</div>
<div class="col-md-8">&nbsp;</div>
<div class="col-md-2" style="text-align: end;">
    @php
    $user = auth()->user();
if($user->tipo==1){
@endphp
<a class="btn btn-primary" href="{{ route('unidad.create') }}">Nueva Unidad</a>
@php
} 
@endphp
</div>
</div>
@stop

@section('content')




<form action="{{ route('unidad.index') }}" method="get">
@csrf

<div class="col-md-12 row" >

    <div class="col-md-3">
    <div class="form-group">
         @php
if($user->tipo==1){
@endphp
                <label>Dependencia</label>
    {{-- Minimal --}}
    <x-adminlte-select2 name="dependencia"  data-placeholder="Selecciona Dependencia....">
        <option @selected(old('depdnencia') == '--') value="--">Seleccionar...</option>
        @foreach($dependencias as $dependencia)
            <option @selected(old('depdnencia') == $dependencia->id) value="{{ $dependencia->id }}">{{ $dependencia->dependencia }}</option>
        @endforeach
    </x-adminlte-select2>
    @php
} 
@endphp
    </div>
    </div>
    <div class="col-md-3"> 
        <div class="form-group">
            <label>Placas</label>
            <input type="text" name="placas" value="{{ old('placas') }}" class="form-control"
               placeholder="Placas"  >
        </div>
    </div>
    <div class="col-md-3"> 
        <div class="form-group">
            <label>No. Económico</label>
            <input type="text" name="no_economico" value="{{ old('no_economico') }}" class="form-control"
               placeholder="No. Económico"  >
        </div>
    </div>
<div class="col-md-3"> 
        <div class="form-group">
            <label>&nbsp;</label>
            <input type="submit" name="buscar" value="Buscar" class="btn btn-success form-control">
        </div>
    </div>


</div>
</form>
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
          
               @foreach($dependencias as $dependencia)
               @if ($dependencia->id == $unidad->dependencia)
              {{  $dependencia->dependencia }}
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
    @php
$user = auth()->user();
if($user->tipo==1){
@endphp
    <a href="{{ route('unidad.edit', $unidad->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
    @php
} 
@endphp
    <a href="{{ route('unidad.combustible', $unidad->id) }}" class="btn btn-primary"><i class="fa-solid fa-gas-pump"></i></a>
    <a href="{{ route('unidad.incidente', $unidad->id) }}" class="btn bg-purple"><i class="fa-solid fa-car-burst"></i></a>
   
</div>
@php
$user = auth()->user();
if($user->tipo==1){
@endphp
<div class="col-md-12" style="padding: 1px; text-align: center;">
<form class="delete-form" action="{{ route('unidad.destroy', $unidad->id) }}" method="post">
                @csrf
                @method('DELETE')
            
                <input type="hidden" name="unidadId" value="{{ $unidad->id }}"  >
              <button class="btn btn-danger">  <span class="fas fa-trash"></span></button>
</form>                   
</div>
@php
} 
@endphp
    </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>


  

    @endforeach
<div class="d-flex justify-content-center text-center col-md-12">
{{ $unidades->links() }}
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