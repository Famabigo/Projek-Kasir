@extends('layouts.app')
@section('title','Detail Transaksi')
@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Detail Transaksi #{{ $transaksi->id }}</h2>
                <a href="{{ route('kasir.transaksi.cetak-struk', $transaksi) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    📄 Cetak Struk
                </a>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Tanggal</p>
                    <p class="font-semibold">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kasir</p>
                    <p class="font-semibold">{{ $transaksi->kasir->name ?? '-' }}</p>
                </div>
                @if($transaksi->member)
                <div>
                    <p class="text-sm text-gray-600">Member</p>
                    <p class="font-semibold">{{ $transaksi->member->nama_member }} ({{ $transaksi->member->kode_member }})</p>
                </div>
                @endif
                @if($transaksi->metode_pembayaran)
                <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-semibold">{{ $transaksi->metode_pembayaran }}</p>
                </div>
                @endif
            </div>
            
            <h3 class="font-bold text-lg mb-4">Item Barang</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transaksi->detail as $d)
                        <tr>
                            <td class="px-4 py-2">{{ $d->barang->nama_barang }}</td>
                            <td class="px-4 py-2">{{ $d->jumlah }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 border-t pt-4">
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($transaksi->total_harga + $transaksi->diskon, 0, ',', '.') }}</span>
                </div>
                @if($transaksi->diskon > 0)
                <div class="flex justify-between mb-2 text-red-600">
                    <span>Diskon</span>
                    <span>- Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="flex justify-between text-xl font-bold border-t pt-2">
                    <span>TOTAL</span>
                    <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="mt-6">
                <a href="{{ route('kasir.transaksi.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Transaksi</a>
            </div>
        </div>
    </div>
</div>
@endsection
