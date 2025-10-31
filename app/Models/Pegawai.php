<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = ['user_id', 'nama', 'alamat', 'no_telp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
