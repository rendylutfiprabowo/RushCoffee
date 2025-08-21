<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model {
    use HasFactory;

    protected $fillable = ['nama_pemesanan', 'uang_dibayar', 'kembalian'];

    public function detailPesanan() {
        return $this->hasMany(DetailPesanan::class);
    }
}

