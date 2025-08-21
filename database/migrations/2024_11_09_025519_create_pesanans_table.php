<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesanan');
            $table->decimal('uang_dibayar', 10, 2);
            $table->decimal('kembalian', 10, 2)->nullable();
            $table->timestamps();
        });
    }
    
    public function down() {
        Schema::dropIfExists('pesanans');
    }
    
};
