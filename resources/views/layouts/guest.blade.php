<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Market - {{ request()->is('register') ? 'Daftar' : 'Login' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .menu-overlay {
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }
        </style>
    </head>
    <body class="font-sans antialiased" x-data="{ menuOpen: false }">
        <!-- Navbar -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-2">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background-color: #0C5587;">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold" style="color: #0C5587;">Market</span>
                    </div>

                    <!-- Menu Button -->
                    <button @click="menuOpen = !menuOpen" class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-colors hover:bg-gray-100">
                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span class="text-sm font-medium" style="color: #0C5587;">Menu</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Dropdown Menu with Blur Background -->
        <div x-show="menuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="menuOpen = false"
             class="fixed inset-0 z-40 menu-overlay bg-black/30"
             style="display: none;">
            
            <div @click.stop class="absolute top-16 left-0 right-0 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Column 1: Belanja -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Belanja</h3>
                            <div class="space-y-2">
                                <a href="{{ route('pembeli.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">Dashboard</p>
                                            <p class="text-xs text-gray-500">Halaman utama</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('pembeli.cart') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">Keranjang</p>
                                            <p class="text-xs text-gray-500">Lihat belanjaan</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Column 2: Kasir -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Kasir</h3>
                            <div class="space-y-2">
                                <a href="{{ route('kasir.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">Dashboard Kasir</p>
                                            <p class="text-xs text-gray-500">Kelola transaksi</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('kasir.transaksi.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">Riwayat Transaksi</p>
                                            <p class="text-xs text-gray-500">Lihat transaksi</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Column 3: Admin -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Admin</h3>
                            <div class="space-y-2">
                                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">Dashboard Admin</p>
                                            <p class="text-xs text-gray-500">Kelola sistem</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('admin.barang.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">Kelola Barang</p>
                                            <p class="text-xs text-gray-500">Data produk</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="min-h-screen flex pt-16">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(12, 85, 135, 0.95) 0%, rgba(8, 132, 209, 0.95) 100%);">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/auth-bg.webp') }}" alt="Market Background" class="w-full h-full object-cover opacity-50">
                </div>
                
                <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                    <div class="max-w-md">
                        <div class="flex items-center space-x-3 mb-8">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                                <svg class="w-7 h-7" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold">Market</span>
                        </div>
                        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Market</h1>
                        <p class="text-lg text-blue-100 mb-8">Platform belanja online terpercaya untuk semua kebutuhan Anda</p>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-white flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold mb-1">Produk Berkualitas</h3>
                                    <p class="text-sm text-blue-100">Ribuan produk pilihan dengan kualitas terjamin</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-white flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold mb-1">Harga Terjangkau</h3>
                                    <p class="text-sm text-blue-100">Dapatkan penawaran terbaik setiap hari</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-white flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold mb-1">Transaksi Aman</h3>
                                    <p class="text-sm text-blue-100">Sistem pembayaran yang aman dan terpercaya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
                <div class="w-full max-w-md">
                    <!-- Logo Mobile -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #0C5587;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold" style="color: #0C5587;">Market</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            @if(request()->is('register'))
                                Buat Akun Baru
                            @else
                                Masuk ke Akun
                            @endif
                        </h2>
                        <p class="text-gray-600">
                            @if(request()->is('register'))
                                Daftar untuk mulai berbelanja
                            @else
                                Selamat datang kembali! Silakan masuk
                            @endif
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
