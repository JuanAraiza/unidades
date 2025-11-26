<!-- resources/views/exports/users.blade.php -->
<table>
    <thead>
        <tr>
            <th>DEPENDENCIA</th>
            <th>FECHA</th>
            <th>NO. ECONOMICO</th>
            <th>COMBUSTIBLE</th>
            <th>FOLIO</th>
            <th>USO</th>
            <th>LITROS</th>
            <th>CHOFER</th>
            <th>KILOMETRAJE</th>
            <th>DESTINO</th>
            <th>AREA ASIGNADA</th>
            <th>GASOLINERA</th>
            <th>COSTO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vales as $vale)
            <tr>
                @php
                    $dependencia = \DB::table('dependencia')->find($vale->dependencia);
                @endphp
                <td>{{ $dependencia->dependencia }}</td>
                <td>{{ $vale->fecha }}</td>
                @php
                    $unidad = \DB::table('unidad')->find($vale->unidad);
                @endphp
                <td>{{ $unidad->no_economico }}</td>
                @php
                    switch ($vale->tipo_com) {
                        case 1:
                            $combust='GAS 1';
                            break;
                        case 2:
                            $combust='GAS 2';
                            break;
                        case 3:
                            $combust='DIESEL';
                            break;
                        case 4:
                            $combust='GAS LP';
                            break;
                        default:
                            $combust='';
                    }
                @endphp
                <td>{{ $combust }}</td>
                <td>{{ $vale->folio }}</td>
                <td>{{ $vale->justificacion }}</td>
                <td>{{ $vale->litros }}</td>
                @php
                    $chofer = \DB::table('operador')->find($vale->operador);
                @endphp
                <td>{{ $chofer->nombre }} {{ $chofer->paterno }} {{ $chofer->materno }}</td>
                <td>{{ $vale->km }}</td>
                <td>{{ $vale->destino }}</td>
                @php
                    $area = \DB::table('area')->find($vale->area);
                @endphp
                <td>{{ $area->area }}</td>
                @php
                    $gasolineria = \DB::table('proveedor')->find($vale->proveedor);
                @endphp
                <td>{{ $gasolineria->gasolinera }}</td>
                <td>{{ $vale->costo }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
