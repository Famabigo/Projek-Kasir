<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = ['nama_barang','kategori','ukuran','harga_beli','harga_jual','stok','gambar','expired_at','deskripsi'];

    protected $casts = [
        'expired_at' => 'datetime',
    ];
}
