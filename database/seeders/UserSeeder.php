<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kasir.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Kasir
        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@kasir.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);

        // Pembeli (Member Approved)
        User::create([
            'name' => 'Farrel',
            'email' => 'farrel@gmail.com',
            'password' => Hash::make('farrel123'),
            'role' => 'pembeli',
            'member_status' => 'approved',
            'kode_member' => 'MBR001',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh No. 123, Jakarta',
        ]);

        // Pembeli 2 (Non Member - Pending)
        User::create([
            'name' => 'Fabian',
            'email' => 'fabian@gmail.com',
            'password' => Hash::make('fabian123'),
            'role' => 'pembeli',
            'member_status' => 'pending',
            'no_hp' => '081234567891',
            'alamat' => 'Jl. Test No. 456, Jakarta',
        ]);
    }
}
