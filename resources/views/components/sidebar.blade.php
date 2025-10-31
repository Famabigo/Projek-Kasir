<nav class="space-y-2 p-4">
  @auth
    @if(auth()->user()->role === 'admin')
      <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>
      <a href="{{ route('admin.pegawai.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pegawai.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('admin.pegawai.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <span class="font-medium">Kelola Pegawai</span>
      </a>
      <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.barang.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('admin.barang.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        <span class="font-medium">Stok Barang</span>
      </a>
      <a href="{{ route('admin.laporan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.laporan.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('admin.laporan.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <span class="font-medium">Laporan Penjualan</span>
      </a>
      <a href="{{ route('admin.notifikasi.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.notifikasi.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('admin.notifikasi.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
          <span class="font-medium">Notifikasi</span>
        </div>
        @php
          $notifCount = \App\Models\LaporanBarang::where('status', 'pending')->count();
        @endphp
        @if($notifCount > 0)
          <span class="px-2 py-1 text-xs font-bold text-white rounded-full" style="background: #C7E339; color: #0C5587;">{{ $notifCount }}</span>
        @endif
      </a>
      <a href="{{ route('admin.member-approval.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.member-approval.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('admin.member-approval.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
          <span class="font-medium">Persetujuan Member</span>
        </div>
        @php
          $memberPendingCount = \App\Models\User::where('member_status', 'pending')->count();
        @endphp
        @if($memberPendingCount > 0)
          <span class="px-2 py-1 text-xs font-bold text-white rounded-full" style="background: #C7E339; color: #0C5587;">{{ $memberPendingCount }}</span>
        @endif
      </a>
    @elseif(auth()->user()->role === 'kasir')
      <a href="{{ route('kasir.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('kasir.dashboard') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('kasir.dashboard') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>
      <a href="{{ route('kasir.transaksi.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('kasir.transaksi.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('kasir.transaksi.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          <span class="font-medium">Transaksi</span>
        </div>
        @php
          $pesananMenungguCount = \App\Models\Pesanan::where('status', 'menunggu')->count();
        @endphp
        @if($pesananMenungguCount > 0)
          <span class="px-2 py-1 text-xs font-bold text-white rounded-full" style="background: #C7E339; color: #0C5587;">{{ $pesananMenungguCount }}</span>
        @endif
      </a>
      <a href="{{ route('kasir.stok.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('kasir.stok.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('kasir.stok.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        <span class="font-medium">Lihat Stok</span>
      </a>
      <a href="{{ route('kasir.members.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('kasir.members.*') || request()->routeIs('kasir.member-approval.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('kasir.members.*') || request()->routeIs('kasir.member-approval.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          <span class="font-medium">Kelola Member</span>
        </div>
        @php
          $memberPendingCount = \App\Models\User::where('member_status', 'pending')->count();
        @endphp
        @if($memberPendingCount > 0)
          <span class="px-2 py-1 text-xs font-bold text-white rounded-full" style="background: #C7E339; color: #0C5587;">{{ $memberPendingCount }}</span>
        @endif
      </a>
    @else
      <a href="{{ route('pembeli.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('pembeli.dashboard') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('pembeli.dashboard') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="font-medium">Beranda</span>
      </a>
      <a href="{{ route('pembeli.cart') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('pembeli.cart') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('pembeli.cart') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span class="font-medium">Keranjang</span>
        @if(session('cart') && count(session('cart')) > 0)
          <span class="ml-auto bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
            {{ count(session('cart')) }}
          </span>
        @endif
      </a>
      <a href="{{ route('pembeli.pesanan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('pembeli.pesanan.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('pembeli.pesanan.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
        </svg>
        <span class="font-medium">Pesanan Saya</span>
      </a>
      <a href="{{ route('pembeli.member-request.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('pembeli.member-request.*') ? 'text-white shadow-lg' : 'text-gray-700 hover:text-white' }}" style="{{ request()->routeIs('pembeli.member-request.*') ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : '' }}" onmouseover="if(!this.classList.contains('shadow-lg')) this.style.background='linear-gradient(135deg, #B1D7F2 30%, #0884D1 100%)'" onmouseout="if(!this.classList.contains('shadow-lg')) this.style.background=''">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
        </svg>
        <span class="font-medium">Daftar Member</span>
        @if(auth()->user()->member_status === 'pending')
          <span class="ml-auto bg-yellow-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">!</span>
        @elseif(auth()->user()->member_status === 'approved')
          <span class="ml-auto bg-green-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">✓</span>
        @endif
      </a>
    @endif
  @endauth
</nav>
