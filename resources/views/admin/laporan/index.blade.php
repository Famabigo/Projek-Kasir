@extends('layouts.app')
@section('title','Laporan Penjualan')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold" style="color: #0C5587;">Laporan Penjualan</h2>
            <p class="text-gray-600 mt-2">Laporan dan analisis transaksi penjualan</p>
        </div>

        <!-- Filter Card -->
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
            <form method="GET" action="{{ route('admin.laporan.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="w-full px-4 py-2 rounded-lg border-gray-300 transition-all" style="border-color: #B1D7F2;" onfocus="this.style.borderColor='#0C5587'; this.style.outline='2px solid #EDF7FC'" onblur="this.style.borderColor='#B1D7F2'; this.style.outline='none'">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="w-full px-4 py-2 rounded-lg border-gray-300 transition-all" style="border-color: #B1D7F2;" onfocus="this.style.borderColor='#0C5587'; this.style.outline='2px solid #EDF7FC'" onblur="this.style.borderColor='#B1D7F2'; this.style.outline='none'">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);" onmouseover="this.style.background='linear-gradient(135deg, #0884D1 0%, #0C5587 100%)'" onmouseout="this.style.background='linear-gradient(135deg, #0C5587 0%, #0884D1 100%)'" >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Filter</span>
                        </button>
                    </div>
                    <div class="flex items-end">
                        <a href="{{ route('admin.laporan.pdf', ['tanggal_mulai' => $tanggalMulai, 'tanggal_akhir' => $tanggalAkhir]) }}" class="w-full bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>PDF</span>
                        </a>
                    </div>
                    <div class="flex items-end">
                        <a href="{{ route('admin.laporan.excel', ['tanggal_mulai' => $tanggalMulai, 'tanggal_akhir' => $tanggalAkhir]) }}" class="w-full bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Excel</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Statistik Periode -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card-hover bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold mb-1">{{ $totalTransaksi }}</div>
                <div class="text-blue-100 text-sm">Total Transaksi</div>
            </div>
            <div class="card-hover bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold mb-1">Rp {{ number_format($totalOmset, 0, ',', '.') }}</div>
                <div class="text-green-100 text-sm">Total Pendapatan</div>
            </div>
            <div class="card-hover rounded-xl shadow-lg p-6 text-white" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold mb-1">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</div>
                <div class="text-white/80 text-sm">Total Keuntungan</div>
            </div>
        </div>
            
        <!-- Tabel Transaksi -->
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);" class="border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kasir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Diskon</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Keuntungan</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transaksi as $t)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-semibold" style="color: #0C5587;">#{{ $t->id }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $t->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $t->kasir->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($t->member)
                                <span class="px-2 py-1 rounded text-xs font-medium text-white" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">{{ $t->member->nama_member }}</span>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-green-600">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($t->diskon, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="font-semibold" style="color: #0C5587;">Rp {{ number_format($t->keuntungan, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.laporan.detail', $t->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center justify-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data transaksi pada periode ini</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $transaksi->appends(['tanggal_mulai' => $tanggalMulai, 'tanggal_akhir' => $tanggalAkhir])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
