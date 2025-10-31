<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['kasir_id','member_id','total_harga','diskon','keuntungan','metode_pembayaran'];

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
