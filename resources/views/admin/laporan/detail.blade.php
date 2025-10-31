@extends('layouts.app')
@section('title','Detail Transaksi')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Detail Transaksi #{{ $transaksi->id }}</h2>
                <p class="text-gray-600 mt-2">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="text-white px-6 py-3 rounded-lg font-medium shadow-lg transition-all duration-200 flex items-center space-x-2" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Info Transaksi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Info Umum -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="font-bold text-lg mb-4" style="color: #0C5587;">Informasi Transaksi</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">ID Transaksi:</span>
                        <span class="font-semibold" style="color: #0C5587;">#{{ $transaksi->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal:</span>
                        <span class="font-semibold">{{ $transaksi->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kasir:</span>
                        <span class="font-semibold">{{ $transaksi->kasir->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Member:</span>
                        <span class="font-semibold">{{ $transaksi->member->nama_member ?? 'Non-Member' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Metode Pembayaran:</span>
                        <span class="font-semibold">{{ $transaksi->metode_pembayaran ?? 'Cash' }}</span>
                    </div>
                </div>
            </div>

            <!-- Info Keuangan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="font-bold text-lg mb-4" style="color: #0C5587;">Rincian Keuangan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-semibold">Rp {{ number_format($transaksi->total_harga + $transaksi->diskon, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Diskon:</span>
                        <span class="font-semibold text-red-600">- Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t">
                        <span class="text-gray-800 font-bold">Total Harga:</span>
                        <span class="font-bold text-green-600 text-xl">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t">
                        <span class="font-bold" style="color: #0C5587;">Keuntungan:</span>
                        <span class="font-bold text-xl" style="color: #0C5587;">Rp {{ number_format($transaksi->keuntungan, 0, ',', '.') }}</span>
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
                        @foreach($transaksi->detail as $detail)
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
    </div>
</div>
@endsection
