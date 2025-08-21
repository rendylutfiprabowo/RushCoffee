@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-0">
                <h5 class="my-2 fW-bold">Riwayat Pemesanan</h5>
                <div class="input-group" style="width: 300px;">
                    <input style="height:40px" type="text" id="search-name" class="form-control"
                        placeholder="Cari Nama Pelanggan">
                    <button class="btn btn-primary" type="button" onclick="searchTransactions()"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>No Pesanan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Data Pesanan</th>
                            <th>Total Pesanan</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-list">
                        @foreach ($pesanans as $index =>  $pesanan)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $pesanan->nama_pemesanan }}</td>
                                <td>{{ $pesanan->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    @foreach ($pesanan->detailPesanan as $detail)
                                        {{ $detail->menu->nama }} ({{ $detail->jumlah }} pcs) - Rp
                                        {{ number_format($detail->harga_total, 2) }}<br>
                                    @endforeach
                                </td>
                                <td>Rp {{ number_format($pesanan->uang_dibayar - $pesanan->kembalian, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Navigasi Halaman -->
    <div class="d-flex justify-content-end">
        {{ $pesanans->links('pagination::bootstrap-4') }}
    </div>

    <!-- JavaScript untuk Pencarian Realtime -->
    <script>
        document.getElementById('search-name').addEventListener('input', function() {
            searchTransactions();
        });

        function searchTransactions() {
            let query = document.getElementById('search-name').value;

            fetch(`/riwayat/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('transaction-list');
                    tableBody.innerHTML = '';

                    data.forEach(pesanan => {
                        let row = `
                    <tr>
                        <td>${pesanan.nama_pemesanan}</td>
                        <td>${pesanan.id}</td>
                        <td>${new Date(pesanan.created_at).toLocaleDateString('id-ID')}</td>
                        <td>${pesanan.detail_pesanan.map(detail => `${detail.menu.nama} (${detail.jumlah} pcs) - Rp ${parseFloat(detail.harga_total).toFixed(2)}`).join('<br>')}</td>
                        <td>Rp ${parseFloat(pesanan.uang_dibayar - pesanan.kembalian).toFixed(2)}</td>
                    </tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                });
        }
    </script>
@endsection
