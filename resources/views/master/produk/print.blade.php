<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Produk</title>
</head>
<body>
<table width="100%">
    <tr>
        @foreach($dataProduk as $p)
            <td style="text-align: center;border: 1px solid;margin-bottom: 2%">
                <p>{{$p->nama_produk}} - Rp. {{format_uang($p->harga_jual)}}</p>
                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($p->nama_produk, 'C39')}}" width="180" height="60">
                <p>{{$p->kode_produk}}</p>
            </td>
            @if($no++ % 3 == 0)
    </tr> <tr>
        @endif
        @endforeach
    </tr>
</table>
</body>
</html>
