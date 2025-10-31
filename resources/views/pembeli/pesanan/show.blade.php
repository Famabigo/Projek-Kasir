@extends('layouts.app')
@section('title','Detail Pesanan')
@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('pembeli.pesanan.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg hover:bg-white transition-colors space-x-2 mb-4" style="color: #0C5587;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-medium">Kembali ke Riwayat Pesanan</span>
        </a>
        <h1 class="text-3xl font-bold" style="color: #0C5587;">Detail Pesanan</h1>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6" style="color: #0C5587;">Status Pesanan</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-bold mb-2" style="color: #0884D1;">{{ $pesanan->kode_pesanan }}</p>
                        <p class="text-gray-600">Dipesan pada {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <span class="px-6 py-3 rounded-full text-lg font-semibold
                            @if($pesanan->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($pesanan->status == 'diproses') bg-blue-100 text-blue-800
                            @elseif($pesanan->status == 'siap_diambil') bg-green-100 text-green-800
                            @elseif($pesanan->status == 'selesai') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Informasi Pengiriman -->
                @if($pesanan->metode_pengiriman === 'pickup')
                    <div class="mt-6 p-4 rounded-lg bg-blue-50 border border-blue-200">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <div class="flex-1">
                                <p class="font-semibold text-blue-900">Ambil di Tempat</p>
                                @if($pesanan->jadwal_ambil)
                                    <p class="text-sm text-blue-700 mt-1">Batas Pengambilan: <strong>{{ $pesanan->jadwal_ambil->format('d M Y, H:i') }}</strong></p>
                                    
                                    @if($pesanan->isTelat() && $pesanan->status !== 'selesai')
                                        <div class="mt-2 p-2 bg-red-50 border border-red-200 rounded">
                                            <p class="text-sm font-semibold text-red-700">⚠️ Terlambat {{ $pesanan->hari_telat }} hari</p>
                                            <p class="text-xs text-red-600">Denda: Rp {{ number_format($pesanan->denda_telat, 0, ',', '.') }} (Rp 5.000/hari)</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif($pesanan->metode_pengiriman === 'delivery')
                    <div class="mt-6 p-4 rounded-lg bg-green-50 border border-green-200">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                            </svg>
                            <div class="flex-1">
                                <p class="font-semibold text-green-900">Diantar</p>
                                <p class="text-sm text-green-700 mt-1"><strong>{{ $pesanan->alamat_pengiriman }}</strong></p>
                                <p class="text-sm text-green-700">No. HP: {{ $pesanan->no_hp_pengiriman }}</p>
                                <p class="text-xs text-green-600 mt-1">Ongkir: Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($pesanan->catatan)
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Catatan</p>
                        <p class="text-gray-800">{{ $pesanan->catatan }}</p>
                    </div>
                @endif

                @if($pesanan->status == 'menunggu')
                    <form action="{{ route('pembeli.pesanan.cancel', $pesanan->id) }}" method="POST" 
                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-colors shadow-md">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>

            <!-- Item Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6" style="color: #0C5587;">Item Pesanan</h2>
                <div class="space-y-4">
                    @foreach($pesanan->details as $detail)
                        <div class="flex items-center space-x-4 pb-4 border-b border-gray-200 last:border-0">
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                                @if($detail->barang->gambar)
                                    <img src="{{ asset('storage/'.$detail->barang->gambar) }}" alt="{{ $detail->barang->nama_barang }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-800">{{ $detail->barang->nama_barang }}</h3>
                                <p class="text-gray-600">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold" style="color: #0884D1;">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold mb-6" style="color: #0C5587;">Ringkasan Pembayaran</h2>
                <div class="space-y-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($pesanan->diskon > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Diskon Member</span>
                        <span>- Rp {{ number_format($pesanan->diskon, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    @if($pesanan->ongkir > 0)
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    @if($pesanan->denda_telat > 0)
                    <div class="flex justify-between text-red-600 font-semibold">
                        <span>Denda Keterlambatan ({{ $pesanan->hari_telat }} hari)</span>
                        <span>+ Rp {{ number_format($pesanan->denda_telat, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold" style="color: #0C5587;">Total Bayar</span>
                            <span class="text-2xl font-bold" style="color: #0884D1;">
                                Rp {{ number_format($pesanan->getTotalDenganDenda(), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
                    </div>
                </div>

                <div class="mt-8 p-4 rounded-lg bg-gradient-to-r from-blue-50 to-green-50">
                    <p class="text-sm text-gray-700 mb-2">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <strong>Informasi:</strong>
                    </p>
                    <p class="text-sm text-gray-600">
                        Silakan ambil pesanan Anda di toko sesuai waktu yang telah dipilih. Jangan lupa bawa kode pesanan ini.
                    </p>
                </div>

                <a href="{{ route('pembeli.dashboard') }}" 
                    class="mt-6 w-full py-3 px-6 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center justify-center space-x-2 border-2"
                    style="border-color: #0C5587; color: #0C5587;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Belanja Lagi</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
