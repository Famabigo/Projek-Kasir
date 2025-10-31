<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HapusProdukExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'barang:hapus-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus otomatis barang yang sudah expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredBarang = \App\Models\Barang::where('expired_at', '<', now())->get();
        
        if ($expiredBarang->count() === 0) {
            $this->info('Tidak ada barang expired yang perlu dihapus.');
            return 0;
        }
        
        $this->info('Ditemukan ' . $expiredBarang->count() . ' barang expired:');
        
        foreach ($expiredBarang as $barang) {
            $this->line('- ' . $barang->nama_barang . ' (Expired: ' . $barang->expired_at->format('d M Y') . ')');
        }
        
        if ($this->confirm('Hapus barang-barang di atas?', true)) {
            $deleted = \App\Models\Barang::where('expired_at', '<', now())->delete();
            $this->info($deleted . ' barang expired berhasil dihapus.');
            return 0;
        }
        
        $this->info('Pembatalan. Tidak ada barang yang dihapus.');
        return 0;
    }
}
