<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Menu::create([
            'nama' => 'Nasi Goreng',
            'harga' => 25000,
            'gambar' => 'images/menu/Nasi Goreng-1755756868.jpg',
        ]);

        \App\Models\Menu::create([
            'nama' => 'Mie Ayam',
            'harga' => 20000,
            'gambar' => 'images/menu/Mie Ayam-1755757032.jpg',
        ]);
    }
}
