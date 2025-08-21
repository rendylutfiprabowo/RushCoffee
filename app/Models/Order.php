<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pemesan', 'total_harga', 'uang_dibayar', 'kembalian'];

    public function orderItems()
    {
        return $this->hasMany(menu::class);
    }
}