<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Member Card</title>

    <style>
        .box {
            position: relative;
            display: flex; /* Added */
            justify-content: space-between; /* Added */
            align-items: center; /* Added */
            width: 100%; /* Added */
            height: 200px; /* Adjust as needed */
            border: 1px solid #fff;
            padding: 8px;
            background: url({{ url('/assets/images/bgcard.png') }}) no-repeat center center; /* Added */
            background-size: cover;
        }

        .logo {
            font-size: 14pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #fff !important;
            display: flex; /* Added */
            flex-direction: column; /* Added */
            align-items: flex-end; /* Added */
        }

        .logo p {
            margin: 0;
        }

        .logo img {
            width: 40px;
            height: 40px;
        }

        .nama {
            font-size: 12pt;
            font-family: Arial, Helvetica, sans-serif;
            color: #fff !important;
            text-align: right;
            margin-right: 16px;
        }

        .telepon {
            color: #fff;
            text-align: right;
            margin-right: 16px;
        }

        .barcode {
            padding: .5px;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<section style="border: 1px solid #fff">
    <table width="100%">
        @foreach ($dataMember as $key => $data)
            <tr>
                @foreach ($data as $item)
                    <td class="text-center" width="50%">
                        <div class="box" >
                            <img src="{{ url('/assets/images/bgcard.png') }}" alt="card" width="50%">
                            <div class="logo" style="margin-top: -30%">
                                <img src="{{ url('/assets/images/logo.png') }}" width="20px" alt="logo">
                                <p style="color: #fc7719">BeliAja</p>
                            </div>
                            <div class="nama" style="margin-top: 15%">{{ $item->nama }}</div>
                            <div class="telepon">{{ $item->telepon }}</div>
                            <div class="barcode text-left" style="margin-top: -35%">
                                <img style="color: #fff" src="data:image/png;base64, {{ DNS2D::getBarcodePNG("$item->kode_member", 'QRCODE') }}" alt="qrcode"
                                     height="45"
                                     widht="45">
                            </div>
                        </div>
                    </td>

                    @if (count($dataMember) == 1)
                        <td class="text-center" style="width: 50%;"></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</section>
</body>
</html>
