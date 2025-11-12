<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kasir_id',
        'kode_pesanan',
        'total_harga',
        'diskon',
        'total_bayar',
        'status',
        'catatan',
        'metode_pengiriman',
        'alamat_pengiriman',
        'no_hp_pengiriman',
        'ongkir',
        'waktu_ambil',
        'jadwal_ambil',
        'tanggal_diambil',
        'hari_telat',
        'denda_telat',
        'keterangan_telat'
    ];

    protected $casts = [
        'waktu_ambil' => 'datetime',
        'jadwal_ambil' => 'datetime',
        'tanggal_diambil' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function details()
    {
        return $this->hasMany(PesananDetail::class);
    }

    public static function generateKodePesanan()
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'PO' . $date . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

        /**
     * Hitung denda keterlambatan
     * Hanya untuk metode pickup, berdasarkan jadwal_ambil (3 hari dari order)
     */
    public function hitungDenda()
    {
        // Hanya untuk pickup
        if ($this->metode_pengiriman !== 'pickup' || !$this->jadwal_ambil) {
            return 0;
        }

        $sekarang = now();
        $jadwal = $this->jadwal_ambil;

        // Jika belum lewat jadwal, tidak ada denda
        if ($sekarang->lte($jadwal)) {
            return 0;
        }

        // Hitung selisih hari (langsung dihitung begitu lewat jadwal)
        // Gunakan ceiling agar hari pertama keterlambatan langsung kena denda
        $hariTelat = $jadwal->diffInDays($sekarang);
        
        // Jika sudah lewat jadwal, minimal 1 hari denda
        if ($hariTelat == 0 && $sekarang->gt($jadwal)) {
            $hariTelat = 1;
        }
        
        // Denda Rp 3.000 per hari
        $denda = $hariTelat * 3000;

        return $denda;
    }

    /**
     * Update denda otomatis
     */
    public function updateDenda()
    {
        $denda = $this->hitungDenda();
        $hariTelat = 0;

        if ($this->metode_pengiriman === 'pickup' && $this->jadwal_ambil && now()->gt($this->jadwal_ambil)) {
            $hariTelat = $this->jadwal_ambil->diffInDays(now());
            
            // Jika sudah lewat jadwal, minimal 1 hari telat
            if ($hariTelat == 0) {
                $hariTelat = 1;
            }
        }

        $this->update([
            'hari_telat' => $hariTelat,
            'denda_telat' => $denda,
        ]);

        return $denda;
    }

    /**
     * Check apakah pesanan telat diambil
     * Berdasarkan jadwal_ambil (3 hari dari order) untuk pickup
     */
    public function isTelat()
    {
        if ($this->metode_pengiriman !== 'pickup' || !$this->jadwal_ambil) {
            return false;
        }

        return now()->gt($this->jadwal_ambil) && !$this->tanggal_diambil;
    }
    
    /**
     * Get total bayar termasuk denda
     */
    public function getTotalDenganDenda()
    {
        return $this->total_bayar + ($this->denda_telat ?? 0);
    }
}
