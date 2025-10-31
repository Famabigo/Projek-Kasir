@extends('layouts.app')
@section('title','Dashboard Kasir')
@section('content')
<div class="py-8" style="background-color: #EDF7FC; min-height: 100vh;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Dashboard Kasir</h2>
        <p class="text-gray-600 text-sm mt-1">Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('kasir.transaksi.create') }}" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md hover-lift">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: #EDF7FC;">
                    <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Transaksi Baru</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Buat penjualan</p>
                </div>
            </div>
        </a>

        <a href="{{ route('kasir.transaksi.index') }}" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md hover-lift">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: #EDF7FC;">
                    <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Riwayat Transaksi</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Lihat transaksi</p>
                </div>
            </div>
        </a>

        <a href="{{ route('kasir.stok.index') }}" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md hover-lift">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: #EDF7FC;">
                    <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Cek Stok</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Lihat stok barang</p>
                </div>
            </div>
        </a>

        <a href="{{ route('kasir.members.index') }}" class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md hover-lift">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: #EDF7FC;">
                    <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Kelola Member</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Manajemen member</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Info Card -->
    <div class="bg-white border border-gray-200 rounded-lg p-8 text-center shadow-sm">
        <svg class="w-16 h-16 mx-auto mb-4" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Sistem Kasir Siap Digunakan</h3>
        <p class="text-gray-600 text-sm">Pilih menu di atas untuk memulai</p>
    </div>
</div>
</div>
@endsection
