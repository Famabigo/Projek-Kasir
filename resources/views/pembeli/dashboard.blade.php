@extends('layouts.app')
@section('title','Beranda')
@section('content')
<div style="background-color: #EDF7FC;">
    <!-- Categories -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-6 overflow-x-auto py-4">
                <button onclick="filterByCategory('all')" class="category-btn active flex flex-col items-center space-y-2 min-w-max transition-colors" data-category="all">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center category-icon" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Semua</span>
                </button>
                <button onclick="filterByCategory('Makanan')" class="category-btn flex flex-col items-center space-y-2 min-w-max transition-colors" data-category="Makanan">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center category-icon" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 7h18M3 11h18m-7 4h7"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Makanan</span>
                </button>
                <button onclick="filterByCategory('Minuman')" class="category-btn flex flex-col items-center space-y-2 min-w-max transition-colors" data-category="Minuman">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center category-icon" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Minuman</span>
                </button>
                <button onclick="filterByCategory('Sembako')" class="category-btn flex flex-col items-center space-y-2 min-w-max transition-colors" data-category="Sembako">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center category-icon" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Sembako</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Banner -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="rounded-xl overflow-hidden" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
            <div class="p-6 md:p-8 text-white">
                <h2 class="text-xl md:text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-sm text-blue-100">Temukan produk terbaik untuk kebutuhan Anda</p>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-900">Daftar Produk Tersedia</h3>
            <span class="text-sm text-gray-500">{{ $barangs->count() }} produk</span>
        </div>

        <!-- Header with Selected Count -->
        <div class="flex items-center justify-between mb-4">
            <span id="selectedCount" class="text-sm font-medium px-3 py-1 rounded-full bg-[#B1D7F2] text-[#0C5587]" style="display: none;">
                0 produk dipilih
            </span>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
            @foreach($barangs as $barang)
            <div class="bg-white rounded-lg overflow-hidden hover:shadow-md transition-all duration-200 border-2 product-card cursor-pointer" 
                id="card-{{ $barang->id }}"
                data-category="{{ $barang->kategori ?? 'Lainnya' }}"
                style="border-color: #e5e7eb;"
                onclick="toggleCardSelection({{ $barang->id }})">
                
                <!-- Image -->
                <div class="relative">
                    <div class="aspect-square bg-gray-50 overflow-hidden">
                        @if($barang->gambar)
                            <img src="{{ asset('storage/'.$barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    @if($barang->stok > 0)
                    <!-- Checkbox for bulk select -->
                    <div class="absolute top-2 left-2 z-10">
                        <div class="bg-white rounded p-1 shadow-md inline-block">
                            <input type="checkbox" 
                                class="w-5 h-5 rounded cursor-pointer pointer-events-none"
                                style="accent-color: #0C5587;"
                                data-product-id="{{ $barang->id }}"
                                data-product-name="{{ $barang->nama_barang }}"
                                data-max-stock="{{ $barang->stok }}">
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="p-3">
                    <div class="min-h-[3rem] mb-2">
                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2">{{ $barang->nama_barang }}</h4>
                        @if($barang->ukuran)
                        <p class="text-xs text-gray-500">{{ $barang->ukuran }}</p>
                        @endif
                    </div>
                    
                    <div class="mb-2">
                        <span class="text-base font-bold" style="color: #0C5587;">Rp {{ number_format($barang->harga_jual ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mb-3">Stok: {{ $barang->stok }}</p>
                    
                    @if($barang->stok > 0)
                    <!-- Quantity Selector (disabled until checked) -->
                    <div class="flex items-center gap-1 mb-2" onclick="event.stopPropagation();">
                        <button type="button" onclick="decrementQty({{ $barang->id }})" 
                            id="dec-{{ $barang->id }}"
                            class="w-8 h-8 rounded flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            -
                        </button>
                        <input type="number" id="qty-{{ $barang->id }}" value="1" min="1" max="{{ $barang->stok }}" 
                            class="w-12 h-8 text-center text-sm font-medium border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#0C5587] disabled:bg-gray-50 disabled:cursor-not-allowed"
                            disabled
                            readonly>
                        <button type="button" onclick="incrementQty({{ $barang->id }}, {{ $barang->stok }})" 
                            id="inc-{{ $barang->id }}"
                            class="w-8 h-8 rounded flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            +
                        </button>
                    </div>
                    
                    <!-- Detail Button -->
                    <a href="{{ route('pembeli.product.show', $barang->id) }}" 
                        onclick="event.stopPropagation()"
                        class="w-full py-2 px-3 text-center text-xs font-medium rounded-lg border transition-colors flex items-center justify-center gap-1"
                        style="border-color: #0C5587; color: #0C5587;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Detail</span>
                    </a>
                    @else
                    <button disabled class="w-full py-2 text-sm font-medium text-white bg-gray-300 rounded-lg cursor-not-allowed">
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Bulk Add Button (Sticky Bottom) -->
        <div id="bulkAddButton" style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 50; width: 90%; max-width: 500px;">
            <button onclick="addAllToCart()" 
                class="w-full py-3 px-6 rounded-lg shadow-lg text-white font-semibold text-base flex items-center justify-center space-x-2 hover:opacity-90 transition-opacity"
                style="background-color: #0C5587;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span id="bulkAddText">Tambah ke Keranjang</span>
            </button>
        </div>

        @if($barangs->isEmpty())
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p class="text-gray-500">Belum ada produk tersedia</p>
        </div>
        @endif
    </div>

    <!-- Member Promotion Banner (Only for non-members) -->
    @if(Auth::user()->member_status !== 'approved')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-br from-[#0C5587] via-[#0884D1] to-[#C7E339] rounded-2xl overflow-hidden shadow-xl">
            <div class="p-8 md:p-10">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Left Content -->
                    <div class="flex-1 text-white">
                        <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="font-bold text-sm">PENAWARAN SPESIAL</span>
                        </div>
                        
                        <h3 class="text-3xl md:text-4xl font-bold mb-3">
                            Jadi Member Sekarang!
                        </h3>
                        <p class="text-lg text-blue-50 mb-6">
                            Nikmati berbagai keuntungan eksklusif dengan bergabung menjadi member kami
                        </p>

                        <!-- Benefits List -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#C7E339]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Diskon Otomatis</p>
                                    <p class="text-sm text-blue-50">Hemat hingga 15% setiap belanja</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#C7E339]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Gratis Ongkir</p>
                                    <p class="text-sm text-blue-50">Untuk metode ambil di tempat</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#C7E339]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Promo Eksklusif</p>
                                    <p class="text-sm text-blue-50">Akses penawaran khusus member</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#C7E339]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Prioritas Layanan</p>
                                    <p class="text-sm text-blue-50">Pelayanan lebih cepat & prioritas</p>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->member_status === 'none')
                            <a href="{{ route('pembeli.member-request.index') }}" 
                               class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                               style="color: #0C5587;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Daftar Member Sekarang
                            </a>
                        @elseif(Auth::user()->member_status === 'pending')
                            <div class="inline-flex items-center px-8 py-4 bg-yellow-400 text-gray-800 rounded-xl font-bold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pendaftaran Sedang Diproses
                            </div>
                        @elseif(Auth::user()->member_status === 'rejected')
                            <a href="{{ route('pembeli.member-request.index') }}" 
                               class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl"
                               style="color: #0C5587;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Daftar Menjadi Member
                            </a>
                        @endif
                    </div>

                    <!-- Right Illustration -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="w-48 h-48 md:w-64 md:h-64 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center">
                                <svg class="w-32 h-32 md:w-40 md:h-40 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .product-card.selected {
        border-color: #0C5587 !important;
        box-shadow: 0 4px 12px rgba(12, 85, 135, 0.15);
    }
    
    .category-btn {
        color: #6B7280;
    }
    
    .category-btn.active {
        color: #0C5587;
    }
    
    .category-btn.active .category-icon {
        background-color: #0C5587 !important;
    }
    
    .category-btn.active svg {
        color: white;
    }
    
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card.hidden {
        display: none;
    }
</style>

<script>
    let selectedProducts = new Map();
    let currentCategory = 'all';

    // Category filter function
    function filterByCategory(category) {
        currentCategory = category;
        
        // Update active button
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[data-category="${category}"]`).classList.add('active');
        
        // Filter products
        const productCards = document.querySelectorAll('.product-card');
        let visibleCount = 0;
        
        productCards.forEach(card => {
            const productCategory = card.getAttribute('data-category');
            
            if (category === 'all' || productCategory === category) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });
        
        // Update product count
        const countElement = document.querySelector('.flex.items-center.justify-between.mb-4 .text-gray-500');
        if (countElement) {
            countElement.textContent = `${visibleCount} produk`;
        }
    }

    function toggleCardSelection(productId) {
        if (!document.getElementById(`qty-${productId}`)) return; // stok habis
        
        const checkbox = document.querySelector(`input[data-product-id="${productId}"]`);
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
            toggleProductSelection(productId);
        }
    }

    function toggleProductSelection(productId) {
        const checkbox = document.querySelector(`input[data-product-id="${productId}"]`);
        const card = document.getElementById(`card-${productId}`);
        const incBtn = document.getElementById(`inc-${productId}`);
        const decBtn = document.getElementById(`dec-${productId}`);
        const qtyInput = document.getElementById(`qty-${productId}`);

        if (checkbox.checked) {
            // Add to selected
            const productName = checkbox.dataset.productName;
            const maxStock = parseInt(checkbox.dataset.maxStock);
            
            selectedProducts.set(productId, {
                name: productName,
                maxStock: maxStock,
                quantity: parseInt(qtyInput.value)
            });

            // Enable controls
            incBtn.disabled = false;
            decBtn.disabled = false;
            qtyInput.disabled = false;
            qtyInput.classList.remove('bg-gray-50');
            
            // Highlight card
            card.classList.add('selected');
        } else {
            // Remove from selected
            selectedProducts.delete(productId);

            // Disable controls
            incBtn.disabled = true;
            decBtn.disabled = true;
            qtyInput.disabled = true;
            qtyInput.classList.add('bg-gray-50');
            qtyInput.value = 1;
            
            // Remove highlight
            card.classList.remove('selected');
        }

        updateSelectedCount();
    }

    function decrementQty(productId) {
        const input = document.getElementById(`qty-${productId}`);
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            if (selectedProducts.has(productId)) {
                selectedProducts.get(productId).quantity = parseInt(input.value);
            }
        }
    }

    function incrementQty(productId, maxStock) {
        const input = document.getElementById(`qty-${productId}`);
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
            if (selectedProducts.has(productId)) {
                selectedProducts.get(productId).quantity = parseInt(input.value);
            }
        }
    }

    function updateSelectedCount() {
        const selectedCount = document.getElementById('selectedCount');
        const bulkAddButton = document.getElementById('bulkAddButton');
        const bulkAddText = document.getElementById('bulkAddText');
        const count = selectedProducts.size;

        if (count > 0) {
            selectedCount.style.display = 'inline-block';
            selectedCount.textContent = `${count} produk dipilih`;
            bulkAddButton.style.display = 'block';
            bulkAddText.textContent = `Tambah ${count} Produk ke Keranjang`;
        } else {
            selectedCount.style.display = 'none';
            bulkAddButton.style.display = 'none';
        }
    }

    async function addAllToCart() {
        if (selectedProducts.size === 0) return;

        const bulkAddButton = document.querySelector('#bulkAddButton button');
        const bulkAddText = document.getElementById('bulkAddText');
        
        // Show loading
        bulkAddButton.disabled = true;
        bulkAddText.innerHTML = '<svg class="animate-spin h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menambahkan...';

        try {
            const products = Array.from(selectedProducts, ([id, data]) => ({
                id: id,
                quantity: data.quantity
            }));

            const response = await fetch('{{ route("pembeli.cart.add-bulk") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ products: products })
            });

            const result = await response.json();

            if (result.success) {
                // Clear selections
                selectedProducts.forEach((data, productId) => {
                    const checkbox = document.querySelector(`input[data-product-id="${productId}"]`);
                    if (checkbox) {
                        checkbox.checked = false;
                        toggleProductSelection(productId);
                    }
                });
                
                // Redirect to cart
                window.location.href = '{{ route("pembeli.cart") }}';
            } else {
                alert(result.message || 'Terjadi kesalahan');
                bulkAddButton.disabled = false;
                updateSelectedCount();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menambahkan produk');
            bulkAddButton.disabled = false;
            updateSelectedCount();
        }
    }
</script>
@endsection
