<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="">
    <title>Laporan Keuangan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 22px;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>LAPORAN KEUANGAN RUSH COFFEE</h1>
    <p>Periode: {{ date('d F Y', strtotime($tanggalAwal)) }} s.d {{ date('d F Y', strtotime($tanggalAkhir)) }}</p>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Transaksi</th>
                <th>Penghasilan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $data)
                <tr>
                    <td>{{ date('d F Y', strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->jumlah_transaksi }}</td>
                    <td>Rp {{ number_format($data->penghasilan, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right; font-weight: bold;">Total:</td>
                <td style="font-weight: bold;">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
