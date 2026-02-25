@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Operador</h1>
@stop

@section('content')

<h1>{{ $operadores->nombre }} {{ $operadores->paterno }} {{ $operadores->materno }}</h1>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
