@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="my-2 fW-bold">Laporan Keuangan Bulanan</h5>
        </div>
        <div class="card-body">
            <div class="container p-4">
                <form method="POST" action="{{ route('keuangan.laporan') }}">
                    @csrf
                    <div class="row g-2 align-items-end">
                        <!-- Tahun -->
                        <div class="col-md-2">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" name="tahun" id="tahun">
                                <option value="" selected disabled>Pilih Tahun</option>
                                @foreach ($tahunBulan as $tahun => $bulans)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bulan -->
                        <div class="col-md-2">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-select" name="bulan" id="bulan">
                                <option value="" selected disabled>Pilih Bulan</option>
                                @if (isset($tahun) && isset($tahunBulan[$tahun]))
                                    @foreach ($tahunBulan[$tahun] as $bulanItem)
                                        <option value="{{ str_pad($bulanItem->bulan, 2, '0', STR_PAD_LEFT) }}">
                                            {{ DateTime::createFromFormat('!m', $bulanItem->bulan)->format('F') }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Tombol -->
                        <div class="col-md-1 d-grid">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                </form>
                @if (isset($laporan))
                    <u>
                        <h5 class="mt-4">Laporan Bulan : <b>{{ $bulanOptions[$bulan] }} {{ $tahun }}</b></h5>
                    </u>
                    <a href="{{ route('keuangan.download', ['tahun' => request('tahun'), 'bulan' => request('bulan')]) }}"
                        class="btn btn-success mt-2 mb-3">Cetak Laporan</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Transaksi</th>
                                <th>Penghasilan</th>
                                <th>Rincian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $index => $data)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ date('d M Y', strtotime($data->tanggal)) }}</td>
                                    <td>{{ $data->jumlah_transaksi }}</td>
                                    <td>{{ number_format($data->penghasilan, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('keuangan.detail', ['tanggal' => $data->tanggal]) }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection
