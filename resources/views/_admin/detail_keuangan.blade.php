<!-- resources/views/detail_keuangan.blade.php -->
@extends('layouts.admin')

@section('content')
<h1>Detail Transaksi Tanggal: {{ $tanggal }}</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Data Pesanan</th>
            <th>Total Pesanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailPesanans as $pesanan)
            <tr>
                <td>{{ $pesanan->id }}</td>
                <td>{{ $pesanan->nama_pemesanan }}</td>
                <td>
                    @foreach($pesanan->detailPesanan as $detail)
                        {{ $detail->menu->nama }} ({{ $detail->jumlah }} pcs) - Rp{{ number_format($detail->harga_total, 0, ',', '.') }}<br>
                    @endforeach
                </td>
                <td>Rp{{ number_format($pesanan->detailPesanan->sum('harga_total'), 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
