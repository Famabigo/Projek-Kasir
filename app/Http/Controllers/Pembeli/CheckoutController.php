<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('pembeli.dashboard')
                ->with('error', 'Keranjang belanja Anda kosong');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        // Cek diskon member otomatis
        $user = Auth::user();
        $diskonPersen = 0;
        $diskonNominal = 0;
        
        // Member otomatis dapat diskon 15% untuk belanja >= 50.000
        if ($user->member_status === 'approved' && $total >= 50000) {
            $diskonPersen = 15;
            $diskonNominal = ($total * $diskonPersen) / 100;
        }
        
        $totalSetelahDiskon = $total - $diskonNominal;
        
        return view('pembeli.checkout', compact('cart', 'total', 'diskonPersen', 'diskonNominal', 'totalSetelahDiskon'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'metode_pengiriman' => 'required|in:pickup,delivery',
            'alamat_pengiriman' => 'required_if:metode_pengiriman,delivery|nullable|string|max:500',
            'no_hp' => 'required_if:metode_pengiriman,delivery|nullable|string|max:20',
            'catatan' => 'nullable|string|max:500',
        ], [
            'metode_pengiriman.required' => 'Silakan pilih metode pengiriman',
            'alamat_pengiriman.required_if' => 'Alamat pengiriman harus diisi untuk metode antar',
            'no_hp.required_if' => 'No. HP harus diisi untuk metode antar',
        ]);
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('pembeli.dashboard')
                ->with('error', 'Keranjang belanja Anda kosong');
        }
        
        DB::beginTransaction();
        try {
            // Hitung total
            $total = 0;
            foreach ($cart as $id => $item) {
                $barang = Barang::find($id);
                
                // Validasi stok
                if ($barang->stok < $item['quantity']) {
                    DB::rollBack();
                    return back()->with('error', "Stok {$barang->nama_barang} tidak mencukupi");
                }
                
                $total += $item['price'] * $item['quantity'];
            }
            
            // Hitung diskon member otomatis
            $user = Auth::user();
            $diskon = 0;
            
            // Member otomatis dapat diskon 15% untuk belanja >= 50.000
            if ($user->member_status === 'approved' && $total >= 50000) {
                $diskon = ($total * 15) / 100;
            }
            
            // Hitung ongkir
            $ongkir = $request->metode_pengiriman === 'delivery' ? 10000 : 0;
            
            $totalBayar = $total - $diskon + $ongkir;
            
            // Set jadwal ambil untuk pickup (3 hari dari sekarang)
            $jadwalAmbil = null;
            if ($request->metode_pengiriman === 'pickup') {
                $jadwalAmbil = now()->addDays(3);
            }
            
            // Buat pesanan
            $pesanan = Pesanan::create([
                'user_id' => Auth::id(),
                'kode_pesanan' => Pesanan::generateKodePesanan(),
                'total_harga' => $total,
                'diskon' => $diskon,
                'total_bayar' => $totalBayar,
                'status' => 'menunggu',
                'catatan' => $request->catatan,
                'metode_pengiriman' => $request->metode_pengiriman,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'no_hp_pengiriman' => $request->no_hp,
                'ongkir' => $ongkir,
                'jadwal_ambil' => $jadwalAmbil,
            ]);
            
            // Simpan detail pesanan (STOK BELUM DIKURANGI, nanti saat selesai)
            foreach ($cart as $id => $item) {
                $barang = Barang::find($id);
                
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'barang_id' => $id,
                    'jumlah' => $item['quantity'],
                    'harga_satuan' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
                
                // STOK TIDAK DIKURANGI DULU, akan dikurangi saat konfirmasi pengambilan di kasir
            }
            
            // Kosongkan keranjang
            session()->forget('cart');
            
            DB::commit();
            
            return redirect()->route('pembeli.pesanan.show', $pesanan->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan ambil pesanan sesuai waktu yang dipilih.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function pesanan(Request $request)
    {
        $query = Pesanan::where('user_id', Auth::id())
            ->with('details.barang');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $request->sampai_tanggal);
        }

        $pesanans = $query->latest()->paginate(10)->withQueryString();
            
        return view('pembeli.pesanan.index', compact('pesanans'));
    }
    
    public function show($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->with('details.barang')
            ->findOrFail($id);
            
        return view('pembeli.pesanan.show', compact('pesanan'));
    }
    
    public function cancel($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);
        
        DB::beginTransaction();
        try {
            // TIDAK perlu kembalikan stok karena stok belum dikurangi saat pesanan dibuat
            // Stok hanya dikurangi saat konfirmasi pengambilan di kasir
            
            $pesanan->update(['status' => 'dibatalkan']);
            
            DB::commit();
            
            return back()->with('success', 'Pesanan berhasil dibatalkan');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan pesanan');
        }
    }
}
