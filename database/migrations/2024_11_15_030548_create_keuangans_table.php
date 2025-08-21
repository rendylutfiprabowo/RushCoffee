<?php

// 2024_11_12_000000_create_keuangans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('jumlah_transaksi');
            $table->decimal('penghasilan', 15, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('keuangans');
    }
};
