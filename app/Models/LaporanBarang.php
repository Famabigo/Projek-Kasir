<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBarang extends Model
{
    use HasFactory;

    protected $table = 'laporan_barang';

    protected $fillable = [
        'kasir_id',
        'barang_id',
        'tipe',
        'keterangan',
        'status',
        'dibaca_at',
    ];

    protected $casts = [
        'dibaca_at' => 'datetime',
    ];

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
