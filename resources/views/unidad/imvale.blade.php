<h1>{{ $vales->folio }}</h1>
<br>
@php
$my_qr_content = "{{ $vales->folio }}";
    $qr = null;
    if (extension_loaded('imagick')) {
       $qr = QrCode::size(2250)
                    ->format('png')
                    ->generate($my_qr_content);
    }
@endphp

@if ($qr)
     <img src="data:image/png;base64,{!! base64_encode($qr) !!}" />
@endif