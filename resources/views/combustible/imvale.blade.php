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



<!--<div class="page-break"></div>-->
@php


$ruta_publica = url('/vervale').'/'.$vales->id;
$my_qr_content = $ruta_publica;
    $qr = null;
    if (extension_loaded('imagick')) {
       $qr = QrCode::size(250)
                    ->format('png')
                    ->generate($my_qr_content);
    }
@endphp

@if ($qr)
     <img src="data:image/png;base64,{!! base64_encode($qr) !!}" />
@endif

</div>
