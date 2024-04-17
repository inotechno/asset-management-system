<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt Transaction</title>

    <style>
        .border-1,
        .border-1 tr,
        .border-1 td {
            border: 1px solid;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>

<body>

    <table style="text-align: center">
        <tr>
            <td><b>{{ strtoupper($transaction->division->company->name) }}</b></td>
        </tr>
        <tr>
            <td>
                <i>
                    Kompleks Dutamas Fatmawati Blok B2 No. 26, RT.1/RW.5, Cipete Utara, Kec. Kby. Baru, Kota Jakarta
                    Selatan, Daerah Khusus Ibukota Jakarta 12150
                </i>
            </td>
        </tr>
        <tr>
            <td>
                <i>
                    Email: trimitra@mindotek.com
                </i>
            </td>
        </tr>
    </table>
    <table style="width: 100%;margin-top:20px;text-align:center">
        <tr>
            <td><b>TANDA TERIMA BARANG</b></td>
        </tr>
        <tr>
            <td>Nomor: 001/XIXI/2020</td>
        </tr>
    </table>

    <p><b>{{ $transaction->date }}</b> telah diterima barang-barang sebagai berikut:</p>

    <table style="width: 100%;" class="border-1">
        <tr>
            <td style="text-align:center;">No</td>
            <td style="text-align:center;">UID</td>
            <td style="text-align:center;">Kategori</td>
            <td style="text-align:center;">Spesifikasi</td>
        </tr>

        @foreach ($transaction->detail as $key => $detail)
            <tr>
                <td style="text-align: center">{{ $key + 1 }}</td>
                <td>{{ $detail->asset->uid }}</td>
                <td>{{ $detail->asset->category->name }}</td>
                <td>{{ $detail->asset->specification }}</td>
            </tr>
        @endforeach

    </table>


    @if ($transaction->status == 0)
        <p style="margin-top: 10px;">Barang telah diterima dalam keadaan baik dan lengkap untuk disimpan.</p>
    @else
        <p style="margin-top: 20px;">Barang telah diterima dalam keadaan baik dan lengkap untuk dipergunakan sebagai
            perlengkapan kantor.</p>
    @endif

    <table style="width: 100%;margin-top:20px;">
        <tr style="text-align: center">
            <td style="font-weight:bold;">Pemberi</td>
            <td style="font-weight:bold;">Penerima</td>
        </tr>

        @if ($transaction->status == 0)
            <tr style="text-align: center;">
                <td style="font-weight:bold;padding-top:80px;">{{ $transaction->employee->name }}</td>
                <td style="font-weight:bold;padding-top:80px;">{{ auth()->user()->name }}</td>
            </tr>
        @else
            <tr style="text-align: center;">
                <td style="font-weight:bold;padding-top:80px;">{{ auth()->user()->name }}</td>
                <td style="font-weight:bold;padding-top:80px;">{{ $transaction->employee->name }}</td>
            </tr>
        @endif
    </table>
</body>

</html>
