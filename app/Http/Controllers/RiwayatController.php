<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil 10 transaksi terakhir
        $pesanans = Pesanan::with('detailPesanan.menu')
            ->latest() // Urutkan berdasarkan waktu terbaru
            ->paginate(10); // Menampilkan 10 transaksi per halaman

        return view('_admin/riwayat', compact('pesanans'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $pesanans = Pesanan::with('detailPesanan.menu')
            ->where('nama_pemesanan', 'like', '%' . $query . '%')
            ->latest()
            ->take(10) // Batasi ke 10 hasil
            ->get();

        return response()->json($pesanans);
    }
}
