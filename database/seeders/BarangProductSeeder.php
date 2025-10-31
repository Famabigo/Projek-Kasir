<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use Carbon\Carbon;

class BarangProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nama_barang' => 'Aqua Botol',
                'kategori' => 'Minuman',
                'ukuran' => '600ml',
                'harga_beli' => 2500,
                'harga_jual' => 3500,
                'stok' => 150,
                'deskripsi' => 'Air mineral kemasan botol',
                'expired_at' => Carbon::now()->addMonths(8)
            ],
            [
                'nama_barang' => 'Beng Beng',
                'kategori' => 'Makanan',
                'ukuran' => '26.5gr',
                'harga_beli' => 1800,
                'harga_jual' => 2500,
                'stok' => 200,
                'deskripsi' => 'Wafer cokelat',
                'expired_at' => Carbon::now()->addMonths(5)
            ],
            [
                'nama_barang' => 'Bimoli Minyak Goreng',
                'kategori' => 'Sembako',
                'ukuran' => '2L',
                'harga_beli' => 28000,
                'harga_jual' => 32000,
                'stok' => 50,
                'deskripsi' => 'Minyak goreng kelapa sawit',
                'expired_at' => Carbon::now()->addMonths(10)
            ],
            [
                'nama_barang' => 'Chitato Rasa Sapi Panggang',
                'kategori' => 'Makanan',
                'ukuran' => '68gr',
                'harga_beli' => 8500,
                'harga_jual' => 11000,
                'stok' => 80,
                'deskripsi' => 'Keripik kentang rasa sapi panggang',
                'expired_at' => Carbon::now()->addMonths(6)
            ],
            [
                'nama_barang' => 'Good Day Cappucino',
                'kategori' => 'Minuman',
                'ukuran' => '250ml',
                'harga_beli' => 4500,
                'harga_jual' => 6500,
                'stok' => 100,
                'deskripsi' => 'Kopi cappucino',
                'expired_at' => Carbon::now()->addMonths(7)
            ],
            [
                'nama_barang' => 'Indomie Goreng',
                'kategori' => 'Makanan',
                'ukuran' => '85gr',
                'harga_beli' => 2800,
                'harga_jual' => 3500,
                'stok' => 300,
                'deskripsi' => 'Mie instan goreng rasa original',
                'expired_at' => Carbon::now()->addMonths(9)
            ],
            [
                'nama_barang' => 'Roti Tawar Sari Roti',
                'kategori' => 'Makanan',
                'ukuran' => '12 slice',
                'harga_beli' => 10000,
                'harga_jual' => 13000,
                'stok' => 60,
                'deskripsi' => 'Roti tawar putih isi 12 lembar',
                'expired_at' => Carbon::now()->addDays(6)
            ],
            [
                'nama_barang' => 'Teh Botol Sosro',
                'kategori' => 'Minuman',
                'ukuran' => '450ml',
                'harga_beli' => 3500,
                'harga_jual' => 5000,
                'stok' => 120,
                'deskripsi' => 'Teh dalam kemasan botol',
                'expired_at' => Carbon::now()->addMonths(4)
            ],
            [
                'nama_barang' => 'Telur Ayam Negeri',
                'kategori' => 'Sembako',
                'ukuran' => '10 butir',
                'harga_beli' => 18000,
                'harga_jual' => 22000,
                'stok' => 40,
                'deskripsi' => 'Telur ayam negeri segar per 10 butir',
                'expired_at' => Carbon::now()->addDays(16)
            ],
            [
                'nama_barang' => 'Ultra Milk Full Cream',
                'kategori' => 'Minuman',
                'ukuran' => '1L',
                'harga_beli' => 14000,
                'harga_jual' => 17000,
                'stok' => 70,
                'deskripsi' => 'Susu UHT full cream kotak',
                'expired_at' => Carbon::now()->addMonths(3)
            ],
        ];

        foreach ($products as $product) {
            Barang::create($product);
        }
    }
}
