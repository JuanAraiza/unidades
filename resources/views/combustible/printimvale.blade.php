<style>
.page-break {
    page-break-after: always;
}
</style>
<div style="align-content: center; text-align: center;">
    <img src="{{ public_path('/assets/img/logoUnidades.png') }}">
<h1>Sistema Unidades</h1>
<h2>Folio: {{ $vales->folio }}</h2>
<br>

<strong>Folio:</strong> {{ $vales->folio }}
        <br>
        <strong>Unidad:</strong> 
        
                            {{  $unidades->placas . ' ' . $unidades->marca  . ' ' . $unidades->modelo . ' ' . $unidades->color  }}
                 
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

</div>
