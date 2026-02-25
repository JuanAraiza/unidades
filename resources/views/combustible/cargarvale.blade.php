@extends('adminlte::auth.auth-page')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop



@section('auth_body')
    <form action="{{ route('combustible.validarCarga') }}" method="post">
        @csrf

        {{-- Email field --}}
        
<input type="hidden" name="vale" value="{{ $vales->id }}" >
        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="contra" name="contra" class="form-control @error('contra') is-invalid @enderror"
placeholder="Contraseña para cargar" autofocus  >

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
           
            <div class="col-12">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
    </form>
@stop
