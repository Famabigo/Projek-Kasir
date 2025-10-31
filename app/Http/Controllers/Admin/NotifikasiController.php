<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanBarang;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $laporans = LaporanBarang::with(['kasir', 'barang'])
            ->orderByRaw("FIELD(status, 'pending', 'dilihat', 'selesai')")
            ->latest()
            ->paginate(20);

        return view('admin.notifikasi.index', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = LaporanBarang::findOrFail($id);
        
        $laporan->status = $request->status;
        if ($request->status === 'dilihat' && !$laporan->dibaca_at) {
            $laporan->dibaca_at = now();
        }
        $laporan->save();

        return back()->with('success', 'Status laporan diperbarui.');
    }

    public function getCount()
    {
        $count = LaporanBarang::where('status', 'pending')->count();
        return response()->json(['count' => $count]);
    }
}
