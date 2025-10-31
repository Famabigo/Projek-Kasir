<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        // Statistik hari ini
        $transaksiHariIni = Transaksi::whereDate('created_at', $today)->count();
        $omsetHariIni = Transaksi::whereDate('created_at', $today)->sum('total_harga');
        $keuntunganHariIni = Transaksi::whereDate('created_at', $today)->sum('keuntungan');
        
        // Statistik bulan ini
        $omsetBulanIni = Transaksi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');
        
        // Total data
        $totalBarang = Barang::count();
        $totalPegawai = Pegawai::count();
        $totalMember = Member::count();
        
        // Barang stok menipis (< 10)
        $barangStokMinim = Barang::where('stok', '<', 10)->get();
        
        // Barang akan expired (< 3 bulan / 90 hari)
        $barangAkanExpired = Barang::where('expired_at', '<=', now()->addDays(90))
            ->where('expired_at', '>=', now())
            ->get();
        
        // Transaksi terbaru
        $transaksiTerbaru = Transaksi::with('kasir', 'member')
            ->latest()
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact(
            'transaksiHariIni',
            'omsetHariIni',
            'keuntunganHariIni',
            'omsetBulanIni',
            'totalBarang',
            'totalPegawai',
            'totalMember',
            'barangStokMinim',
            'barangAkanExpired',
            'transaksiTerbaru'
        ));
    }
}
