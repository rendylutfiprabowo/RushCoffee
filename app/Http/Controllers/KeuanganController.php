<?php
// app/Http/Controllers/KeuanganController.php
namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Pesanan;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
// use PDF as PDF;
USE Barryvdh\DomPDF\Facade\Pdf AS PDF;

class KeuanganController extends Controller {

    public function index() {
        // Ambil tahun dan bulan yang memiliki transaksi
        $tahunBulan = Pesanan::selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->groupBy('tahun');
    
        return view('_admin/keuangan', [
            'tahunBulan' => $tahunBulan
        ]);
    }
    
    public function getLaporan(Request $request) {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
    
        if (!$tahun || !$bulan) {
            return redirect()->route('keuangan.index')->with('error', 'Pilih tahun dan bulan terlebih dahulu.');
        }
    
        $tanggalAwal = "$tahun-$bulan-01";
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal));
    
        // Dapatkan transaksi pada bulan dan tahun yang dipilih
        $laporan = Pesanan::selectRaw('DATE(created_at) as tanggal, COUNT(id) as jumlah_transaksi, SUM(uang_dibayar) as penghasilan')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Dropdown options tetap dipertahankan
        $bulanOptions = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
    
        return view('_admin/keuangan', [
            'laporan' => $laporan,
            'tahunBulan' => Pesanan::selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan')
                ->distinct()
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'asc')
                ->get()
                ->groupBy('tahun'),
            'tahun' => $tahun,
            'bulan' => $bulan,
            'bulanOptions' => $bulanOptions
        ]);
    }


    public function downloadPdf(Request $request)
    {
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');

        if (!$tahun || !$bulan) {
            return redirect()->route('keuangan.index')->with('error', 'Pilih tahun dan bulan terlebih dahulu.');
        }

        $tanggalAwal = "$tahun-$bulan-01";
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal));

        $laporan = Pesanan::selectRaw('DATE(created_at) as tanggal, COUNT(id) as jumlah_transaksi, SUM(uang_dibayar) as penghasilan')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $totalPenghasilan = $laporan->sum('penghasilan');
        $pdf = PDF::loadView('templates.keuangan_pdf', compact('laporan', 'tahun', 'bulan', 'totalPenghasilan', 'tanggalAwal', 'tanggalAkhir'));

        return $pdf->download("Laporan_Keuangan_{$tahun}_{$bulan}.pdf");
    }

    
    public function getDetail($tanggal) {
        // Ambil detail transaksi dari Pesanan
        $detailPesanans = Pesanan::whereDate('created_at', $tanggal)->get();
        return view('detail_keuangan', compact('detailPesanans', 'tanggal'));
    }
}
