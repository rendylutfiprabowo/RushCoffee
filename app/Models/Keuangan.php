<?php
// app/Models/Keuangan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model {
    use HasFactory;

    protected $fillable = ['tanggal', 'jumlah_transaksi', 'penghasilan'];

    public function detailPesanans() {
        return $this->hasMany(Pesanan::class, 'tanggal', 'tanggal');
    }
}
