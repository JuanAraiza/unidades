@extends('adminlte::page')

@section('title', 'AVIZOR')

@section('content_header')
    <h1>Area</h1>
@stop

@section('content')

<h1>{{ $areas->area }}</h1>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
