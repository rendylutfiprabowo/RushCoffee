<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Ghalib',
                'username' => 'admin1',
                'password' => Hash::make('admin123'),
                'phone' => '08123456789',
                'address' => 'Jl. Eka Tunggal Perum PIP i.15',
                'role_id' => 1,
            ],
            [
                'name' => 'Hilya',
                'username' => 'kasir1',
                'password' => Hash::make('kasir123'),
                'phone' => '08987654321',
                'address' => 'Jl. Melati Kubang',
                'role_id' => 2, 
            ],
        ]);
    }
}

