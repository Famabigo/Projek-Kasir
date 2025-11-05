<?php
/**
 * Cek apakah member_id tersimpan di transaksi
 * Akses: http://127.0.0.1:8000/cek_member_transaksi.php
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Transaksi;
use App\Models\User;

echo "<!DOCTYPE html>
<html>
<head>
    <title>Cek Member di Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        h1 {
            color: #0C5587;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #0C5587;
            color: white;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .null {
            color: red;
        }
        .info {
            background: #e3f2fd;
            padding: 10px;
            border-left: 4px solid #2196f3;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>🔍 Cek Member ID di Transaksi (5 Terakhir)</h1>
    <div class='info'>
        <strong>Tujuan:</strong> Memastikan member_id tersimpan dengan benar di database transaksi
    </div>
    <table>
        <tr>
            <th>Transaksi ID</th>
            <th>Member ID</th>
            <th>Nama Member</th>
            <th>Total Harga</th>
            <th>Diskon</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>";

$transaksi = Transaksi::with('member')->latest()->take(5)->get();

foreach ($transaksi as $t) {
    $memberId = $t->member_id ?? '<span class="null">NULL</span>';
    $memberName = $t->member ? $t->member->name : '<span class="null">Non-Member</span>';
    $status = $t->member_id ? "<span class='success'>✅ ADA MEMBER</span>" : "<span class='null'>❌ TIDAK ADA</span>";
    
    echo "<tr>
        <td>#{$t->id}</td>
        <td>{$memberId}</td>
        <td>{$memberName}</td>
        <td>Rp " . number_format($t->total_harga, 0, ',', '.') . "</td>
        <td>Rp " . number_format($t->diskon, 0, ',', '.') . "</td>
        <td>{$t->created_at->format('d/m/Y H:i')}</td>
        <td>{$status}</td>
    </tr>";
}

echo "</table>

<h2 style='margin-top: 40px;'>📊 Summary</h2>
<table>
    <tr>
        <th>Keterangan</th>
        <th>Jumlah</th>
    </tr>
    <tr>
        <td>Total Transaksi</td>
        <td>" . Transaksi::count() . "</td>
    </tr>
    <tr>
        <td>Transaksi dengan Member</td>
        <td class='success'>" . Transaksi::whereNotNull('member_id')->count() . "</td>
    </tr>
    <tr>
        <td>Transaksi Non-Member</td>
        <td>" . Transaksi::whereNull('member_id')->count() . "</td>
    </tr>
</table>

</body>
</html>";
