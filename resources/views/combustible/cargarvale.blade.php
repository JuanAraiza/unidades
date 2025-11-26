@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <h1>Vale Combustible</h1>
@stop

@section('content')

        <strong>Folio:</strong> {{ $vales->folio }}
        <br>
        <strong>Unidad:</strong> 
        @foreach($unidades as $unidad)
                            {{ $vales->unidad == $unidad->id ? $unidad->placas . ' ' . $unidad->marca  . ' ' . $unidad->modelo . ' ' . $unidad->color : '' }}
                        @endforeach
        <br>
        <strong>Operador:</strong>  @foreach($operadores as $operador)
                            {{ $vales->operador == $operador->id ? $operador->nombre . ' ' . $operador->paterno . ' ' . $operador->materno : '' }}
                        @endforeach
        <br>
        <strong>Litros:</strong> {{ $vales->litros }} L
        <br>
        <strong>Kilometraje:</strong> {{ $vales->kilometraje }} Km
        <br>
        <strong>Tipo Combustible:</strong>{{ $vales->tipo_com == 1 ? 'Gas 1' : ($vales->tipo_com == 2 ? 'Gas 2' : ($vales->tipo_com == 3 ? 'Diesel' : 'Gas LP')) }}
        <br>
        <strong>Proveedor:</strong> @foreach($proveedores as $proveedor)
                            {{ $vales->proveedor == $proveedor->id ? $proveedor->gasolinera : '' }}
                        @endforeach
                        <br>
        <strong>Estatus:</strong> 
        @switch($vales->estatus)
            @case(1)
                Para Validar
                @break
        
            @case(2)
                <h3>Validado</h3>
                @break
        
            @default
                <span class="bg-red" style="border-radius:5px; padding:5px 10px 5px 10px; font-size:30px;">Cargado</span>
        @endswitch
        
        @if($vales->estatus==2)
<br>&nbsp;<br>


        <form method="POST" action="{{ route('combustible.cargarvaledos',$vales->id ) }}">
            @csrf
            <input type="hidden" name="id" value="{{ $vales->id }}">
       

            @switch($vales->tipo_com)
                @case(1)
                     <div class="form-group " style="background-color: #ffbfbf;">  
                &nbsp;<input type="radio" id="radioPrimary1" name="tip_gasolina" checked value="1" style="height:30px; width:30px;" >
                <label for="radioPrimary1" style="font-size:40px;">
                &nbsp;Magna
                </label>
            </div>

            <div class="form-group " style="background-color: #c1ffbf;">
                &nbsp;<input type="radio" id="radioPrimary2" name="tip_gasolina" value="2" style="height:30px; width:30px;" >
                <label for="radioPrimary2" style="font-size:40px;">
                &nbsp;Premium
                </label>
            </div>
                    @break
            
               
            
                @case(3)
                <br>&nbsp;<br>
                     <input type="hidden" name="tip_gasolina" value="3" >
                    @break

                @case(4)
                <br>&nbsp;<br>
                    <input type="hidden" name="tip_gasolina" value="4" >
                    @break
            
            @endswitch

           

              <div class="form-group">
            <label>Litros</label>
            <input type="text" name="litros"  onKeyPress="return valida(event)"   class="form-control"
               value="{{ $vales->litros }}" autofocus >
               <input type="hidden" name="olitros"  value="{{ $vales->litros }}"  >
        </div>

            


              <div class="form-group">
            <label>Folio Sat</label>
            <input type="text" name="folio_sat"    class="form-control"
               value="{{ old('folio_sat') }}" autofocus >
               
        </div>



            <button type="submit" class="btn btn-success  btn-lg btn-block col-md-12">&nbsp;<br><h2>Cargar Gasolina</h2>&nbsp;</button>


        </form>


@endif



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
