@extends('layouts.app')
@section('title','Dashboard Admin')
@section('content')
<div class="py-8" style="background-color: #EDF7FC; min-height: 100vh;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Dashboard Admin</h2>
            <p class="text-gray-600 text-sm mt-1">Selamat datang kembali, {{ auth()->user()->name }}</p>
        </div>
        
        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Transaksi Hari Ini -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1 text-gray-900">{{ $transaksiHariIni }}</div>
                <div class="text-gray-600 text-sm">Transaksi Hari Ini</div>
            </div>

            <!-- Pendapatan Hari Ini -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1 text-gray-900">Rp {{ number_format($omsetHariIni, 0, ',', '.') }}</div>
                <div class="text-gray-600 text-sm">Pendapatan Hari Ini</div>
            </div>

            <!-- Keuntungan Hari Ini -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1 text-gray-900">Rp {{ number_format($keuntunganHariIni, 0, ',', '.') }}</div>
                <div class="text-gray-600 text-sm">Keuntungan Hari Ini</div>
            </div>

            <!-- Pendapatan Bulan Ini -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1 text-gray-900">Rp {{ number_format($omsetBulanIni, 0, ',', '.') }}</div>
                <div class="text-gray-600 text-sm">Pendapatan Bulan Ini</div>
            </div>
        </div>
        
        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Total Barang</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalBarang }}</p>
                    </div>
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-8 h-8" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Total Pegawai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalPegawai }}</p>
                    </div>
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-8 h-8" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Total Member</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalMember }}</p>
                    </div>
                    <div class="rounded-lg p-3" style="background-color: #EDF7FC;">
                        <svg class="w-8 h-8" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Alerts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            @if($barangStokMinim->count() > 0)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start space-x-3">
                    <div class="rounded-lg p-3 flex-shrink-0" style="background-color: #FEF3C7;">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                            Stok Menipis 
                            <span class="ml-2 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $barangStokMinim->count() }}</span>
                        </h3>
                        <div class="space-y-2">
                            @foreach($barangStokMinim->take(5) as $barang)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                                <span class="text-sm text-gray-700">{{ $barang->nama_barang }}</span>
                                <span class="text-sm font-semibold text-yellow-600">Stok: {{ $barang->stok }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            @if($barangAkanExpired->count() > 0)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start space-x-3">
                    <div class="rounded-lg p-3 flex-shrink-0" style="background-color: #FEE2E2;">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                            Akan Expired 
                            <span class="ml-2 bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $barangAkanExpired->count() }}</span>
                        </h3>
                        <div class="space-y-2">
                            @foreach($barangAkanExpired->take(5) as $barang)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                                <span class="text-sm text-gray-700">{{ $barang->nama_barang }}</span>
                                <span class="text-sm font-semibold text-red-600">{{ $barang->expired_at ? $barang->expired_at->format('d M Y') : '-' }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Transaksi Terbaru -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg text-gray-900">Transaksi Terbaru</h3>
                <a href="{{ route('admin.laporan.index') }}" class="text-sm font-medium flex items-center" style="color: #0C5587;" onmouseover="this.style.color='#0884D1'" onmouseout="this.style.color='#0C5587'">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID Transaksi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kasir</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transaksiTerbaru as $t)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3">
                                <span class="font-semibold" style="color: #0C5587;">#{{ $t->id }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $t->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $t->kasir->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-green-600">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
