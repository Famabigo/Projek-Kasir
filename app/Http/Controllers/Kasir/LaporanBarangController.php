<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\LaporanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanBarangController extends Controller
{
    public function index()
    {
        // Ambil barang yang expired atau akan expired dalam 3 bulan (90 hari)
        $barangExpired = Barang::whereNotNull('expired_at')
            ->where('expired_at', '<=', Carbon::now()->addDays(90))
            ->get();

        // Ambil barang dengan stok menipis (< 10)
        $barangStokMenipis = Barang::where('stok', '<', 10)->get();

        // Ambil riwayat laporan kasir ini
        $riwayatLaporan = LaporanBarang::with('barang')
            ->where('kasir_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('kasir.laporan-barang.index', compact('barangExpired', 'barangStokMenipis', 'riwayatLaporan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tipe' => 'required|in:expired,stok_menipis',
            'keterangan' => 'nullable|string',
        ]);

        // Cek apakah sudah pernah dilaporkan dan masih pending
        $existing = LaporanBarang::where('barang_id', $request->barang_id)
            ->where('tipe', $request->tipe)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'Barang ini sudah dilaporkan sebelumnya dan masih menunggu tindakan admin.');
        }

        LaporanBarang::create([
            'kasir_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tipe' => $request->tipe,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim ke admin.');
    }
}
