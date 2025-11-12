<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Member;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // all, online, offline
        
        // Get online orders (pesanan)
        $pesananQuery = Pesanan::with(['user', 'details.barang'])
            ->whereIn('status', ['menunggu', 'diproses', 'siap_diambil', 'selesai'])
            ->latest();
        
        // Get offline transactions
        $transaksiQuery = Transaksi::with(['kasir', 'member', 'detail.barang'])
            ->latest();
        
        if ($filter === 'online') {
            $pesanan = $pesananQuery->paginate(20);
            $transaksi = collect(); // Empty collection
        } elseif ($filter === 'offline') {
            $pesanan = collect(); // Empty collection
            $transaksi = $transaksiQuery->paginate(20);
        } else {
            // Show both
            $pesanan = $pesananQuery->get();
            $transaksi = $transaksiQuery->get();
        }
            
        return view('kasir.transaksi.index', compact('pesanan', 'transaksi', 'filter'));
    }

    public function create()
    {
        $barang = Barang::where('stok','>',0)->get();
        // Get approved members from users table
        $members = \App\Models\User::where('role', 'pembeli')
            ->where('member_status', 'approved')
            ->orderBy('name')
            ->get();
        return view('kasir.transaksi.create', compact('barang','members'));
    }

    public function store(Request $request)
    {
        // Clean empty string to null for member_id
        if ($request->has('member_id') && $request->input('member_id') === '') {
            $request->merge(['member_id' => null]);
        }
        
        $data = $request->validate([
            'member_id' => 'nullable|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barang,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_beli' => 'required|numeric',
            'items.*.harga_jual' => 'required|numeric',
            'diskon' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $totalKeuntungan = 0;
            
            // Validasi stok dan hitung total
            foreach ($data['items'] as $it) {
                if (!isset($it['jumlah']) || $it['jumlah'] < 1) {
                    continue; // Skip item tanpa jumlah
                }
                
                $b = Barang::find($it['barang_id']);
                
                // Cek stok
                if ($b->stok < $it['jumlah']) {
                    throw new \Exception("Stok {$b->nama_barang} tidak mencukupi. Tersedia: {$b->stok}");
                }
                
                $subtotal = $b->harga_jual * $it['jumlah'];
                $total += $subtotal;
                
                // Hitung keuntungan per item
                $keuntunganItem = ($b->harga_jual - $b->harga_beli) * $it['jumlah'];
                $totalKeuntungan += $keuntunganItem;
            }

            // Hitung diskon
            $diskonManual = $data['diskon'] ?? 0;
            $diskonMember = 0;
            $member = null;
            
            if (!empty($data['member_id'])) {
                $member = \App\Models\User::find($data['member_id']);
                // Diskon member hanya berlaku jika total belanja >= 50.000
                if ($member && $member->diskon_member > 0 && $total >= 50000) {
                    $diskonMember = $total * ($member->diskon_member / 100);
                }
            }
            
            $totalDiskon = $diskonManual + $diskonMember;
            $totalSetelahDiskon = max(0, $total - $totalDiskon);

            // Buat transaksi
            $transaksi = Transaksi::create([
                'kasir_id' => Auth::id(),
                'member_id' => $data['member_id'] ?? null,
                'total_harga' => $totalSetelahDiskon,
                'diskon' => $totalDiskon,
                'keuntungan' => $totalKeuntungan,
                'metode_pembayaran' => 'Cash', // Default cash untuk transaksi offline
            ]);

            // Simpan detail transaksi
            foreach ($data['items'] as $it) {
                if (!isset($it['jumlah']) || $it['jumlah'] < 1) {
                    continue; // Skip item tanpa jumlah
                }
                
                $b = Barang::find($it['barang_id']);
                $jumlah = $it['jumlah'];
                $subtotal = $b->harga_jual * $jumlah;

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $b->id,
                    'jumlah' => $jumlah,
                    'harga_beli' => $b->harga_beli,
                    'harga_jual' => $b->harga_jual,
                    'harga_satuan' => $b->harga_jual,
                    'subtotal' => $subtotal,
                ]);

                // Update stok
                $b->decrement('stok', $jumlah);
            }

            DB::commit();
            
            return redirect()->route('kasir.transaksi.show', $transaksi->id)
                ->with('success', 'Transaksi berhasil disimpan!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('detail.barang','kasir','member');
        return view('kasir.transaksi.show', compact('transaksi'));
    }
    
    public function cetakStruk(Transaksi $transaksi)
    {
        $transaksi->load('detail.barang','kasir','member');
        $pdf = Pdf::loadView('kasir.transaksi.struk', compact('transaksi'));
        return $pdf->download('struk-transaksi-' . $transaksi->id . '.pdf');
    }

    public function getPesananDetail($id)
    {
        $pesanan = Pesanan::with(['user', 'details.barang'])->findOrFail($id);
        
        // Update denda jika ada jadwal_ambil dan belum diambil
        if ($pesanan->jadwal_ambil && !$pesanan->tanggal_diambil) {
            $pesanan->updateDenda();
            $pesanan->refresh();
        }
        
        return response()->json([
            'pesanan' => [
                'id' => $pesanan->id,
                'kode_pesanan' => $pesanan->kode_pesanan,
                'status' => $pesanan->status,
                'total_harga' => $pesanan->total_harga,
                'diskon' => $pesanan->diskon,
                'total_bayar' => $pesanan->total_bayar,
                'catatan' => $pesanan->catatan,
                'metode_pengiriman' => $pesanan->metode_pengiriman,
                'alamat_pengiriman' => $pesanan->alamat_pengiriman,
                'no_hp_pengiriman' => $pesanan->no_hp_pengiriman,
                'ongkir' => $pesanan->ongkir ?? 0,
                'waktu_ambil_formatted' => $pesanan->waktu_ambil ? $pesanan->waktu_ambil->format('d M Y, H:i') : null,
                'jadwal_ambil' => $pesanan->jadwal_ambil,
                'jadwal_ambil_formatted' => $pesanan->jadwal_ambil ? $pesanan->jadwal_ambil->format('d M Y, H:i') : null,
                'tanggal_diambil' => $pesanan->tanggal_diambil,
                'tanggal_diambil_formatted' => $pesanan->tanggal_diambil ? $pesanan->tanggal_diambil->format('d M Y, H:i') : null,
                'hari_telat' => $pesanan->hari_telat ?? 0,
                'denda_telat' => $pesanan->denda_telat ?? 0,
                'is_telat' => $pesanan->isTelat(),
                'user' => [
                    'name' => $pesanan->user->name,
                    'email' => $pesanan->user->email ?? '',
                ]
            ],
            'details' => $pesanan->details->map(function($detail) {
                return [
                    'barang' => [
                        'nama_barang' => $detail->barang->nama_barang,
                    ],
                    'jumlah' => $detail->jumlah,
                    'harga' => $detail->harga_satuan,
                    'subtotal' => $detail->subtotal,
                ];
            })
        ]);
    }

    public function setJadwalAmbil(Request $request, $id)
    {
        $request->validate([
            'jadwal_ambil' => 'required|date|after:now'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        
        $pesanan->update([
            'jadwal_ambil' => $request->jadwal_ambil,
            'status' => 'siap_diambil'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal pengambilan berhasil diatur'
        ]);
    }

    public function konfirmasiPengambilan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Hitung denda jika telat (untuk pickup)
        $pesanan->updateDenda();
        
        DB::beginTransaction();
        try {
            // Validasi stok
            foreach ($pesanan->details as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang->stok < $detail->jumlah) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok {$barang->nama_barang} tidak mencukupi"
                    ], 400);
                }
            }
            
            // Hitung keuntungan
            $totalKeuntungan = 0;
            foreach ($pesanan->details as $detail) {
                $barang = Barang::find($detail->barang_id);
                $keuntunganItem = ($barang->harga_jual - $barang->harga_beli) * $detail->jumlah;
                $totalKeuntungan += $keuntunganItem;
            }
            
            // Total bayar termasuk denda
            $totalBayarFinal = $pesanan->getTotalDenganDenda();
            
            // Update pesanan dengan total baru (termasuk denda)
            $pesanan->update([
                'total_bayar' => $totalBayarFinal,
                'tanggal_diambil' => now(),
                'status' => 'selesai'
            ]);
            
            // Buat transaksi baru
            $transaksi = Transaksi::create([
                'kasir_id' => Auth::id(),
                'member_id' => null,
                'total_harga' => $totalBayarFinal,
                'diskon' => $pesanan->diskon,
                'keuntungan' => $totalKeuntungan,
                'metode_pembayaran' => $pesanan->metode_pengiriman === 'delivery' ? 'Online - Antar' : 'Online - Pickup' . ($pesanan->denda_telat > 0 ? ' + Denda' : ''),
            ]);
            
            // Kurangi stok dan buat transaksi detail
            foreach ($pesanan->details as $detail) {
                $barang = Barang::find($detail->barang_id);
                
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $detail->barang_id,
                    'jumlah' => $detail->jumlah,
                    'harga_beli' => $barang->harga_beli,
                    'harga_jual' => $barang->harga_jual,
                    'harga_satuan' => $detail->harga_satuan,
                    'subtotal' => $detail->subtotal,
                ]);
                
                $barang->decrement('stok', $detail->jumlah);
            }
            
            DB::commit();
            
            $message = 'Pengambilan barang berhasil dikonfirmasi';
            if ($pesanan->denda_telat > 0) {
                $message .= '. Denda keterlambatan: Rp ' . number_format($pesanan->denda_telat, 0, ',', '.');
            }
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'denda' => $pesanan->denda_telat,
                'hari_telat' => $pesanan->hari_telat
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengkonfirmasi pengambilan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updatePesananStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,siap_diambil,selesai,dibatalkan'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        
        // Assign kasir yang bertanggung jawab (jika belum ada)
        if (!$pesanan->kasir_id) {
            $pesanan->kasir_id = auth()->id();
        }
        
        // Jika dibatalkan, kembalikan stok
        if ($request->status === 'dibatalkan' && $pesanan->status !== 'dibatalkan') {
            DB::beginTransaction();
            try {
                foreach ($pesanan->details as $detail) {
                    $barang = Barang::find($detail->barang_id);
                    $barang->increment('stok', $detail->jumlah);
                }
                
                $pesanan->status = $request->status;
                $pesanan->save();
                
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan dibatalkan dan stok dikembalikan'
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membatalkan pesanan: ' . $e->getMessage()
                ], 500);
            }
        }
        
        // If completing order, reduce stock and create transaksi
        if ($request->status === 'selesai' && $pesanan->status !== 'selesai') {
            DB::beginTransaction();
            try {
                // Validasi stok
                foreach ($pesanan->details as $detail) {
                    $barang = Barang::find($detail->barang_id);
                    if ($barang->stok < $detail->jumlah) {
                        return response()->json([
                            'success' => false,
                            'message' => "Stok {$barang->nama_barang} tidak mencukupi"
                        ], 400);
                    }
                }
                
                // Hitung keuntungan
                $totalKeuntungan = 0;
                foreach ($pesanan->details as $detail) {
                    $barang = Barang::find($detail->barang_id);
                    $keuntunganItem = ($barang->harga_jual - $barang->harga_beli) * $detail->jumlah;
                    $totalKeuntungan += $keuntunganItem;
                }
                
                // Buat transaksi baru
                $transaksi = Transaksi::create([
                    'kasir_id' => Auth::id(),
                    'member_id' => null, // Pesanan online tidak perlu member_id
                    'total_harga' => $pesanan->total_bayar,
                    'diskon' => $pesanan->diskon,
                    'keuntungan' => $totalKeuntungan,
                    'metode_pembayaran' => 'Online',
                ]);
                
                // Kurangi stok dan buat transaksi detail
                foreach ($pesanan->details as $detail) {
                    $barang = Barang::find($detail->barang_id);
                    
                    TransaksiDetail::create([
                        'transaksi_id' => $transaksi->id,
                        'barang_id' => $detail->barang_id,
                        'jumlah' => $detail->jumlah,
                        'harga_beli' => $barang->harga_beli,
                        'harga_jual' => $barang->harga_jual,
                        'harga_satuan' => $detail->harga_satuan,
                        'subtotal' => $detail->subtotal,
                    ]);
                    
                    $barang->decrement('stok', $detail->jumlah);
                }
                
                $pesanan->status = $request->status;
                $pesanan->save();
                
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengupdate status: ' . $e->getMessage()
                ], 500);
            }
        } else {
            $pesanan->status = $request->status;
            $pesanan->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diupdate'
        ]);
    }
}
