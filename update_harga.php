<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Update semua barang dengan harga_beli = 70% dari harga_jual
$barangs = DB::table('barang')->get();

foreach ($barangs as $barang) {
    DB::table('barang')
        ->where('id', $barang->id)
        ->update([
            'harga_beli' => $barang->harga_jual * 0.7
        ]);
}

echo "Successfully updated " . count($barangs) . " items!\n";
