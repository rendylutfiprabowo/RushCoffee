<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Kategori::create([
            'nama' => 'Makanan',
        ]);
        \App\Models\Kategori::create([
            'nama' => 'Minuman',
        ]);
    }
}
