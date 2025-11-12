<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Barang;
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
        $filterPembeli = $request->input('filter_pembeli', 'all'); // 'all', 'member', 'non-member'
        $barangId = $request->input('barang_id');
        $filterMetode = $request->input('filter_metode', 'all'); // 'all', 'online', 'offline'
        
        // Build query for Transaksi (Offline)
        $queryTransaksi = Transaksi::with('kasir', 'member', 'detail.barang')
            ->whereBetween('created_at', [
                Carbon::parse($tanggalMulai)->startOfDay(),
                Carbon::parse($tanggalAkhir)->endOfDay()
            ]);
        
        // Filter by pembeli type
        if ($filterPembeli === 'member') {
            $queryTransaksi->whereNotNull('member_id'); // Hanya transaksi dengan member
        } elseif ($filterPembeli === 'non-member') {
            $queryTransaksi->whereNull('member_id'); // Hanya transaksi tanpa member
        }
        
        // Filter by barang if selected
        if ($barangId) {
            $queryTransaksi->whereHas('detail', function($q) use ($barangId) {
                $q->where('barang_id', $barangId);
            });
        }
        
        // Build query for Pesanan (Online)
        $queryPesanan = Pesanan::with('user', 'kasir', 'details.barang')
            ->whereBetween('created_at', [
                Carbon::parse($tanggalMulai)->startOfDay(),
                Carbon::parse($tanggalAkhir)->endOfDay()
            ]);
        
        // Filter pesanan by pembeli type
        if ($filterPembeli === 'non-member') {
            // Pesanan online tidak ada non-member
            $queryPesanan->whereRaw('1 = 0');
        }
        
        // Filter by barang
        if ($barangId) {
            $queryPesanan->whereHas('details', function($q) use ($barangId) {
                $q->where('barang_id', $barangId);
            });
        }
        
        // Statistik - hitung berdasarkan filter metode
        $totalOmset = 0;
        $totalKeuntungan = 0;
        $totalTransaksi = 0;
        
        if ($filterMetode === 'offline' || $filterMetode === 'all') {
            $totalOmset += (clone $queryTransaksi)->sum('total_harga');
            $totalKeuntungan += (clone $queryTransaksi)->sum('keuntungan');
            $totalTransaksi += (clone $queryTransaksi)->count();
        }
        
        if ($filterMetode === 'online' || $filterMetode === 'all') {
            $totalOmset += (clone $queryPesanan)->sum('total_bayar');
            $totalTransaksi += (clone $queryPesanan)->count();
            // Hitung keuntungan dari pesanan online
            $pesananOnline = (clone $queryPesanan)->with('details')->get();
            foreach ($pesananOnline as $pesanan) {
                foreach ($pesanan->details as $detail) {
                    $totalKeuntungan += ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
                }
            }
        }
        
        // Paginate based on filter
        if ($filterMetode === 'offline') {
            $transaksi = $queryTransaksi->latest()->paginate(20);
        } elseif ($filterMetode === 'online') {
            $transaksi = $queryPesanan->latest()->paginate(20);
        } else {
            // Show both - combine and paginate manually
            $allData = $queryTransaksi->latest()->get()
                ->merge($queryPesanan->latest()->get())
                ->sortByDesc('created_at');
            
            // Manual pagination
            $page = request()->get('page', 1);
            $perPage = 20;
            $transaksi = new \Illuminate\Pagination\LengthAwarePaginator(
                $allData->forPage($page, $perPage),
                $allData->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
        
        // Get barang for filter dropdown
        $barang = Barang::orderBy('nama_barang')->get();
        
        return view('kasir.laporan.index', compact(
            'transaksi',
            'tanggalMulai',
            'tanggalAkhir',
            'totalOmset',
            'totalKeuntungan',
            'totalTransaksi',
            'barang',
            'filterPembeli',
            'barangId',
            'filterMetode'
        ));
    }
    
    public function exportPdf(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', now()->startOfMonth()->format('Y-m-d'));
        $tanggalAkhir = $request->input('tanggal_akhir', now()->format('Y-m-d'));
        $filterPembeli = $request->input('filter_pembeli', 'all');
        $barangId = $request->input('barang_id');
        $filterMetode = $request->input('filter_metode', 'all');
        
        $allData = collect();
        
        // Build query for Transaksi (Offline)
        if ($filterMetode === 'offline' || $filterMetode === 'all') {
            $queryTransaksi = Transaksi::with('kasir', 'member', 'detail.barang')
                ->whereBetween('created_at', [
                    Carbon::parse($tanggalMulai)->startOfDay(),
                    Carbon::parse($tanggalAkhir)->endOfDay()
                ]);
            
            // Filter by pembeli type
            if ($filterPembeli === 'member') {
                $queryTransaksi->whereNotNull('member_id');
            } elseif ($filterPembeli === 'non-member') {
                $queryTransaksi->whereNull('member_id');
            }
            
            // Filter by barang
            if ($barangId) {
                $queryTransaksi->whereHas('detail', function($q) use ($barangId) {
                    $q->where('barang_id', $barangId);
                });
            }
            
            $allData = $allData->merge($queryTransaksi->latest()->get());
        }
        
        // Build query for Pesanan (Online)
        if ($filterMetode === 'online' || $filterMetode === 'all') {
            $queryPesanan = Pesanan::with('user', 'kasir', 'details.barang')
                ->whereBetween('created_at', [
                    Carbon::parse($tanggalMulai)->startOfDay(),
                    Carbon::parse($tanggalAkhir)->endOfDay()
                ]);
            
            if ($filterPembeli === 'non-member') {
                $queryPesanan->whereRaw('1 = 0');
            }
            
            if ($barangId) {
                $queryPesanan->whereHas('details', function($q) use ($barangId) {
                    $q->where('barang_id', $barangId);
                });
            }
            
            $allData = $allData->merge($queryPesanan->latest()->get());
        }
        
        $transaksi = $allData->sortByDesc('created_at');
        
        $totalOmset = 0;
        $totalKeuntungan = 0;
        
        foreach ($transaksi as $item) {
            if (isset($item->user)) {
                // Pesanan online
                $totalOmset += $item->total_bayar;
                // Hitung keuntungan dari details
                foreach ($item->details as $detail) {
                    $totalKeuntungan += ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
                }
            } else {
                // Transaksi offline
                $totalOmset += $item->total_harga;
                $totalKeuntungan += $item->keuntungan;
            }
        }
        
        $pdf = Pdf::loadView('kasir.laporan.pdf', compact(
            'transaksi',
            'tanggalMulai',
            'tanggalAkhir',
            'totalOmset',
            'totalKeuntungan',
            'filterPembeli',
            'filterMetode',
            'barangId'
        ));
        
        return $pdf->download('laporan-penjualan-' . now()->format('Y-m-d') . '.pdf');
    }
    
    public function exportExcel(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', now()->startOfMonth()->format('Y-m-d'));
        $tanggalAkhir = $request->input('tanggal_akhir', now()->format('Y-m-d'));
        $filterPembeli = $request->input('filter_pembeli', 'all');
        $barangId = $request->input('barang_id');
        $filterMetode = $request->input('filter_metode', 'all');
        
        return Excel::download(
            new LaporanExport($tanggalMulai, $tanggalAkhir, $filterPembeli, $barangId, $filterMetode),
            'laporan-penjualan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
    
    public function detail($id)
    {
        $transaksi = Transaksi::with(['kasir', 'member', 'detail.barang'])->findOrFail($id);
        
        return view('kasir.laporan.detail', compact('transaksi'));
    }
    
    public function detailPesanan($id)
    {
        $pesanan = Pesanan::with(['user', 'kasir', 'details.barang'])->findOrFail($id);
        
        return view('kasir.laporan.detail-pesanan', compact('pesanan'));
    }
}
