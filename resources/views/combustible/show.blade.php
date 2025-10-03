@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Vale Combustible</h1>
@stop

@section('content')
 @foreach($vales as $vale)
        <strong>Folio:</strong> {{ $vale->folio }}
        <br>
        <strong>Unidad:</strong> 
        @foreach($unidades as $unidad)
                            {{ $vale->unidad == $unidad->id ? $unidad->placas . ' ' . $unidad->marca  . ' ' . $unidad->modelo . ' ' . $unidad->color : '' }}
                        @endforeach
        <br>
        <strong>Operador:</strong>  @foreach($operadores as $operador)
                            {{ $vale->operador == $operador->id ? $operador->nombre . ' ' . $operador->paterno . ' ' . $operador->materno : '' }}
                        @endforeach
        <br>
        <strong>Litros:</strong> {{ $vale->litros }} L
        <br>
        <strong>Kilometraje:</strong> {{ $vale->kilometraje }} Km
        <br>
        <strong>Tipo Combustible:</strong>{{ $vale->tipo_com == 1 ? 'Gas 1' : ($vale->tipo_com == 2 ? 'Gas 2' : ($vale->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}
        <br>
        <strong>Proveedor:</strong> @foreach($proveedores as $proveedor)
                            {{ $vale->proveedor == $proveedor->id ? $proveedor->gasolinera : '' }}
                        @endforeach
                        <br>
        <strong>Estatus:</strong> 
        @switch($vale->estatus)
    @case(1)
        Para Validar
        @break
 
    @case(2)
        Validado
        @break
 
    @default
        Cargado
@endswitch
        
        
@endforeach

@stop

@section('css')

<style>
    .main-sidebar{
        display: none
    }
    .navbar{
        display: none
    }
</style >
@stop

@section('js')
@stop
