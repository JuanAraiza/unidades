@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Tipos de Vehículo</h1>
@stop

@section('content')

<h1>{{ $tipovs->tipo }}</h1>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
