@extends('layouts.app')
@section('title','Keranjang Belanja')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6" style="background-color: #EDF7FC; min-height: 100vh;">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center space-x-3">
                <a href="{{ route('pembeli.dashboard') }}" class="p-2 rounded-lg bg-white hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Keranjang Belanja</h1>
            </div>
            
            @if(isset($cart) && count($cart) > 0)
                <form action="{{ route('pembeli.cart.clear') }}" method="POST" onsubmit="return confirm('Hapus semua item dari keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span>Kosongkan</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if(isset($cart) && count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-3">
                @foreach($cart as $id => $item)
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center gap-4">
                            <!-- Product Image -->
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-gray-50">
                                @if($item['image'])
                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $item['name'] }}</h3>
                                @if(isset($item['ukuran']) && $item['ukuran'])
                                    <p class="text-xs text-gray-500 mb-1">{{ $item['ukuran'] }}</p>
                                @endif
                                <p class="text-lg font-bold" style="color: #0C5587;">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="flex items-center gap-3">
                                <form action="{{ route('pembeli.cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold">
                                        -
                                    </button>
                                    <span class="w-10 text-center font-medium text-sm">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold">
                                        +
                                    </button>
                                </form>

                                <!-- Remove Button -->
                                <form action="{{ route('pembeli.cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Subtotal -->
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Subtotal:</span>
                                <span class="text-base font-bold" style="color: #0C5587;">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg p-6 sticky top-24">
                    <h2 class="text-lg font-bold mb-4 text-gray-900">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal ({{ count($cart) }} item)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Biaya Layanan</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Total</span>
                                <span class="text-xl font-bold" style="color: #0C5587;">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('pembeli.checkout') }}" class="block w-full py-3 px-4 rounded-lg text-white text-center font-medium hover:opacity-90 transition-opacity"
                        style="background-color: #0C5587;">
                        Lanjut ke Checkout
                    </a>

                    <p class="mt-3 text-xs text-gray-500 text-center">
                        Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami
                    </p>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="bg-white rounded-lg p-16">
            <div class="text-center">
                <div class="mb-6 flex justify-center">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center bg-gray-100">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-xl font-bold mb-2 text-gray-900">Keranjang Belanja Kosong</h2>
                <p class="text-gray-600 mb-6">Yuk, mulai belanja dan tambahkan produk ke keranjang!</p>
                <a href="{{ route('pembeli.dashboard') }}" 
                    class="inline-flex items-center px-6 py-3 rounded-lg text-white font-medium hover:opacity-90 transition-opacity space-x-2"
                    style="background-color: #0C5587;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Mulai Belanja</span>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection