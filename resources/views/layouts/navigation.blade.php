<nav x-data="{ open: false, menuOpen: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left: Logo & Menu Button -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="flex items-center justify-center w-9 h-9 rounded" style="background-color: #0C5587;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold" style="color: #0C5587;">ShopEase</span>
                </a>

                <!-- Menu Button -->
                <button @click="menuOpen = !menuOpen" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors relative">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Menu</span>
                    @auth
                    @if(auth()->user()->role === 'admin')
                        @php
                            $laporanPending = \App\Models\LaporanBarang::where('status', 'pending')->count();
                        @endphp
                        @if($laporanPending > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold animate-pulse">
                            {{ $laporanPending }}
                        </span>
                        @endif
                    @endif
                    @endauth
                </button>
            </div>

            <!-- Center: Search Bar (untuk pembeli) -->
            @auth
            @if(auth()->user()->role === 'pembeli')
            <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                <div class="relative w-full">
                    <input type="text" placeholder="Cari produk..." class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#0C5587] focus:ring-1 focus:ring-[#0C5587]">
                    <button class="absolute right-0 top-0 h-full px-4 rounded-r-lg" style="background-color: #0C5587;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endif
            @endauth

            <!-- Right: Icons & Profile -->
            <div class="flex items-center space-x-4">
                @auth
                @if(auth()->user()->role === 'pembeli')
                <!-- Cart Icon -->
                <a href="{{ route('pembeli.cart') }}" class="relative p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @php
                        $cartCount = session('cart') ? count(session('cart')) : 0;
                    @endphp
                    @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </a>
                @endif
                
                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 p-1.5 hover:bg-gray-100 rounded-lg">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full text-white font-semibold text-sm" style="background-color: #0C5587;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
                            <span class="inline-block mt-1.5 px-2 py-0.5 text-xs font-medium rounded" style="background-color: #EDF7FC; color: #0C5587;">
                                {{ ucfirst(Auth::user()->role ?? 'User') }}
                            </span>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </div>
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="flex items-center text-red-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="open = ! open" class="p-2 rounded-lg hover:bg-gray-100">
                    <svg class="h-6 w-6 text-gray-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Dropdown Menu with Blur Background -->
    <div x-show="menuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="menuOpen = false"
         class="fixed inset-0 z-40"
         style="backdrop-filter: blur(10px); background-color: rgba(0, 0, 0, 0.3);">
    </div>

    <div x-show="menuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="fixed top-0 left-0 right-0 z-50 bg-white shadow-lg">
        
        @auth
        @if(auth()->user()->role === 'pembeli')
        <div class="px-6 py-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-4 gap-6">
                <a href="{{ route('pembeli.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('pembeli.dashboard') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pembeli.cart') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('pembeli.cart') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Keranjang</span>
                </a>
                <a href="{{ route('pembeli.pesanan.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('pembeli.pesanan.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('pembeli.member-request.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('pembeli.member-request.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Member</span>
                </a>
            </div>
        </div>
        @endif

        @if(auth()->user()->role === 'kasir')
        <div class="px-6 py-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-5 gap-6">
                <a href="{{ route('kasir.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('kasir.dashboard') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kasir.transaksi.create') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('kasir.transaksi.create') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Transaksi Baru</span>
                </a>
                <a href="{{ route('kasir.transaksi.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('kasir.transaksi.index') || request()->routeIs('kasir.transaksi.show') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Riwayat Transaksi</span>
                </a>
                <a href="{{ route('kasir.stok.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('kasir.stok.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Cek Stok</span>
                </a>
                <a href="{{ route('kasir.members.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('kasir.members.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Kelola Member</span>
                </a>
            </div>
        </div>
        @endif

        @if(auth()->user()->role === 'admin')
        <div class="px-6 py-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-6 gap-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('admin.dashboard') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('admin.barang.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Barang</span>
                </a>
                <a href="{{ route('admin.notifikasi.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('admin.notifikasi.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="relative">
                        Notifikasi
                        @php
                            $laporanPending = \App\Models\LaporanBarang::where('status', 'pending')->count();
                        @endphp
                        @if($laporanPending > 0)
                        <span class="absolute -top-2 -right-6 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold animate-pulse shadow-lg">
                            {{ $laporanPending }}
                        </span>
                        @endif
                    </span>
                </a>
                <a href="{{ route('admin.pegawai.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('admin.pegawai.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Pegawai</span>
                </a>
                <a href="{{ route('admin.member-approval.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('admin.member-approval.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Member</span>
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#0C5587] pb-2 {{ request()->routeIs('admin.laporan.*') ? 'border-b-2 border-[#0C5587] text-[#0C5587]' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Laporan</span>
                </a>
            </div>
        </div>
        @endif
        @endauth
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t">
        <div class="px-4 py-3 space-y-1">
            @auth
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded text-gray-700 hover:bg-gray-100">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded text-gray-700 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded text-red-600 hover:bg-gray-100">Keluar</button>
            </form>
            @endauth
        </div>
    </div>
</nav>
