@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Dependencia</h1>
@stop

@section('content')

<h1>{{ $dependencias->dependencia }}</h1>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
