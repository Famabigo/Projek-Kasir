<?php

use Illuminate\Support\Facades\Route;

Route::get('/check-data', function() {
    echo "<h2>Users:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Member Status</th></tr>";
    foreach(\App\Models\User::all() as $u) {
        echo "<tr>";
        echo "<td>{$u->id}</td>";
        echo "<td>{$u->name}</td>";
        echo "<td>{$u->email}</td>";
        echo "<td>{$u->role}</td>";
        echo "<td>{$u->member_status}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Pegawai:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nama</th><th>User Email</th></tr>";
    foreach(\App\Models\Pegawai::with('user')->get() as $p) {
        echo "<tr>";
        echo "<td>{$p->id}</td>";
        echo "<td>{$p->nama}</td>";
        echo "<td>" . ($p->user ? $p->user->email : 'none') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Barang:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th></tr>";
    foreach(\App\Models\Barang::all() as $b) {
        echo "<tr>";
        echo "<td>{$b->id}</td>";
        echo "<td>{$b->nama_barang}</td>";
        echo "<td>{$b->kategori}</td>";
        echo "<td>Rp " . number_format($b->harga, 0, ',', '.') . "</td>";
        echo "<td>{$b->stok}</td>";
        echo "</tr>";
    }
    echo "</table>";
});
