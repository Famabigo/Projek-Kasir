@extends('layouts.app')
@section('title','Detail Pesanan Online')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Detail Pesanan {{ $pesanan->kode_pesanan }}</h2>
                <p class="text-gray-600 mt-2">{{ $pesanan->created_at->format('d M Y H:i') }}</p>
                <span class="inline-block mt-2 px-3 py-1 rounded text-sm font-semibold bg-green-100 text-green-700">Online</span>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="text-white px-6 py-3 rounded-lg font-medium shadow-lg transition-all duration-200 flex items-center space-x-2" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Info Pesanan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Info Umum -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="font-bold text-lg mb-4" style="color: #0C5587;">Informasi Pesanan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kode Pesanan:</span>
                        <span class="font-semibold" style="color: #0C5587;">{{ $pesanan->kode_pesanan }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Order:</span>
                        <span class="font-semibold">{{ $pesanan->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Pembeli:</span>
                        <span class="font-semibold">{{ $pesanan->user->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kasir Penanggung Jawab:</span>
                        <span class="font-semibold">{{ $pesanan->kasir->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-semibold">
                            @if($pesanan->status == 'pending')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                            @elseif($pesanan->status == 'diproses')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">Diproses</span>
                            @elseif($pesanan->status == 'siap_diambil')
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs">Siap Diambil</span>
                            @elseif($pesanan->status == 'selesai')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Selesai</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Dibatalkan</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Metode Pengiriman:</span>
                        <span class="font-semibold">{{ ucfirst($pesanan->metode_pengiriman ?? 'Pickup') }}</span>
                    </div>
                </div>
            </div>

            <!-- Info Keuangan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="font-bold text-lg mb-4" style="color: #0C5587;">Rincian Keuangan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-semibold">Rp {{ number_format($pesanan->total_harga + $pesanan->diskon, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Diskon:</span>
                        <span class="font-semibold text-red-600">- Rp {{ number_format($pesanan->diskon, 0, ',', '.') }}</span>
                    </div>
                    @if($pesanan->ongkir > 0)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkir:</span>
                        <span class="font-semibold">Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between pt-3 border-t">
                        <span class="text-gray-800 font-bold">Total Bayar:</span>
                        <span class="font-bold text-green-600 text-xl">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t">
                        <span class="font-bold" style="color: #0C5587;">Keuntungan:</span>
                        <span class="font-bold text-xl" style="color: #0C5587;">
                            @php
                                $totalKeuntungan = 0;
                                foreach ($pesanan->details as $detail) {
                                    $totalKeuntungan += ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
                                }
                            @endphp
                            Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Barang -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                <h3 class="font-bold text-lg" style="color: #0C5587;">Detail Barang</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);" class="border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga Beli</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga Jual</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Subtotal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Keuntungan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pesanan->details as $detail)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $detail->barang->nama_barang }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-700">Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $detail->jumlah }} pcs</td>
                            <td class="px-6 py-4 font-semibold text-green-600">Rp {{ number_format($detail->harga_jual * $detail->jumlah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-semibold" style="color: #0C5587;">Rp {{ number_format(($detail->harga_jual - $detail->harga_beli) * $detail->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($pesanan->catatan)
        <!-- Catatan -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
            <h3 class="font-bold text-lg mb-2 text-yellow-800">Catatan Pembeli</h3>
            <p class="text-gray-700">{{ $pesanan->catatan }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
