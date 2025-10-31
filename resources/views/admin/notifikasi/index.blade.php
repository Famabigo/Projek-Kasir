@extends('layouts.app')
@section('title','Notifikasi Laporan')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold" style="color: #0C5587;">Notifikasi Laporan Barang</h2>
            <p class="text-gray-600 mt-2">Kelola laporan dari kasir tentang barang expired dan stok menipis</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg border-2 border-green-400 bg-green-50 text-green-800">
            {{ session('success') }}
        </div>
        @endif

        <!-- Card Table -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Kasir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Keterangan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($laporans as $lap)
                        <tr class="hover:bg-blue-50 {{ $lap->status === 'pending' ? 'bg-yellow-50' : '' }}">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-800">{{ $lap->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $lap->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $lap->kasir->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $lap->barang->nama_barang }}</div>
                                <div class="text-xs text-gray-500">
                                    Stok: <span class="font-semibold">{{ $lap->barang->stok }}</span>
                                    @if($lap->barang->expired_at)
                                        | Expired: {{ $lap->barang->expired_at->format('d M Y') }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($lap->tipe === 'expired')
                                    @if($lap->barang->expired_at && $lap->barang->expired_at->isPast())
                                        <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-semibold whitespace-nowrap" style="background: #fee2e2; color: #991b1b;">
                                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Expired</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-semibold whitespace-nowrap" style="background: #fef3c7; color: #92400e;">
                                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Akan Expired</span>
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-semibold whitespace-nowrap" style="background: #fed7aa; color: #9a3412;">
                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
                                        </svg>
                                        <span>Stok Menipis</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">{{ $lap->keterangan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($lap->status === 'pending')
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-semibold flex items-center space-x-1 w-fit">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                        </svg>
                                        <span>Menunggu</span>
                                    </span>
                                @elseif($lap->status === 'dilihat')
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">Dilihat</span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    @if($lap->status === 'pending')
                                        <form action="{{ route('admin.notifikasi.update-status', $lap->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="dilihat">
                                            <button type="submit" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs font-medium transition-all">
                                                Tandai Dilihat
                                            </button>
                                        </form>
                                    @endif
                                    @if($lap->status !== 'selesai')
                                        <form action="{{ route('admin.notifikasi.update-status', $lap->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-xs font-medium transition-all">
                                                Selesai
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.barang.edit', $lap->barang_id) }}" class="px-3 py-1 rounded-lg text-xs font-medium transition-all" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%); color: white;">
                                        Edit Barang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">Belum ada laporan dari kasir</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($laporans->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $laporans->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
