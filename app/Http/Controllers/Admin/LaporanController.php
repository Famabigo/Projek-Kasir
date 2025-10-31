<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', now()->startOfMonth()->format('Y-m-d'));
        $tanggalAkhir = $request->input('tanggal_akhir', now()->format('Y-m-d'));
        
        $transaksi = Transaksi::with('kasir', 'member', 'detail.barang')
            ->whereBetween('created_at', [
                Carbon::parse($tanggalMulai)->startOfDay(),
                Carbon::parse($tanggalAkhir)->endOfDay()
            ])
            ->latest()
            ->paginate(20);
        
        // Statistik periode
        $totalOmset = Transaksi::whereBetween('created_at', [
            Carbon::parse($tanggalMulai)->startOfDay(),
            Carbon::parse($tanggalAkhir)->endOfDay()
        ])->sum('total_harga');
        
        $totalKeuntungan = Transaksi::whereBetween('created_at', [
            Carbon::parse($tanggalMulai)->startOfDay(),
            Carbon::parse($tanggalAkhir)->endOfDay()
        ])->sum('keuntungan');
        
        $totalTransaksi = Transaksi::whereBetween('created_at', [
            Carbon::parse($tanggalMulai)->startOfDay(),
            Carbon::parse($tanggalAkhir)->endOfDay()
        ])->count();
        
        return view('admin.laporan.index', compact(
            'transaksi',
            'tanggalMulai',
            'tanggalAkhir',
            'totalOmset',
            'totalKeuntungan',
            'totalTransaksi'
        ));
    }
    
    public function exportPdf(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', now()->startOfMonth()->format('Y-m-d'));
        $tanggalAkhir = $request->input('tanggal_akhir', now()->format('Y-m-d'));
        
        $transaksi = Transaksi::with('kasir', 'member', 'detail.barang')
            ->whereBetween('created_at', [
                Carbon::parse($tanggalMulai)->startOfDay(),
                Carbon::parse($tanggalAkhir)->endOfDay()
            ])
            ->latest()
            ->get();
        
        $totalOmset = $transaksi->sum('total_harga');
        $totalKeuntungan = $transaksi->sum('keuntungan');
        
        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'transaksi',
            'tanggalMulai',
            'tanggalAkhir',
            'totalOmset',
            'totalKeuntungan'
        ));
        
        return $pdf->download('laporan-penjualan-' . now()->format('Y-m-d') . '.pdf');
    }
    
    public function exportExcel(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', now()->startOfMonth()->format('Y-m-d'));
        $tanggalAkhir = $request->input('tanggal_akhir', now()->format('Y-m-d'));
        
        return Excel::download(
            new LaporanExport($tanggalMulai, $tanggalAkhir),
            'laporan-penjualan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
    
    public function detail($id)
    {
        $transaksi = Transaksi::with(['kasir', 'member', 'detail.barang'])->findOrFail($id);
        
        return view('admin.laporan.detail', compact('transaksi'));
    }
}
