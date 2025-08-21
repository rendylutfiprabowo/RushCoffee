<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('harga', 10, 2);
            $table->string('gambar')->nullable();
            $table->timestamps();
            // $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('menus');
    }
};