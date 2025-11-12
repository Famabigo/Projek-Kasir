
<?php $__env->startSection('title','Buat Transaksi'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-6" style="background-color: #EDF7FC; min-height: 100vh;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('kasir.dashboard')); ?>" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">Buat Transaksi Baru</h2>
                </div>
            </div>
            <p class="text-sm text-gray-600">Pilih produk dan tambahkan ke keranjang transaksi</p>
        </div>

        <!-- Error Messages -->
        <?php if($errors->any()): ?>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-semibold text-red-800">Terjadi Kesalahan!</p>
                    <ul class="mt-1 text-sm text-red-700">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('kasir.transaksi.store')); ?>" id="transaksiForm">
            <?php echo csrf_field(); ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Side - Product List -->
                <div class="lg:col-span-2">
                    <!-- Member Selection -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Gunakan Member?
                        </h3>
                        
                        <!-- Toggle Member -->
                        <div class="flex gap-3 mb-4">
                            <button type="button" 
                                    onclick="toggleMemberUsage(false);" 
                                    id="btnNoMember"
                                    style="flex: 1; padding: 12px 16px; border-radius: 8px; border: 2px solid #0C5587; background-color: #EBF5FF; color: #0C5587; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                                Tidak
                            </button>
                            <button type="button" 
                                    onclick="toggleMemberUsage(true);" 
                                    id="btnYesMember"
                                    style="flex: 1; padding: 12px 16px; border-radius: 8px; border: 2px solid #D1D5DB; background-color: white; color: #374151; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                                Ya, Gunakan Member
                            </button>
                        </div>
                        
                        <!-- Member Selection (Hidden by default) -->
                        <div id="memberSelectionBox" style="display: none;">
                            <!-- Search Member with Autocomplete -->
                            <div class="relative mb-3" id="searchMemberContainer">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" id="searchIcon">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="searchMember" 
                                       placeholder="Ketik nama atau kode member..." 
                                       autocomplete="off"
                                       oninput="searchMembersLive()"
                                       onfocus="searchMembersLive()"
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent text-sm">
                                
                                <!-- Dropdown Results -->
                                <div id="memberDropdown" style="display: none;" class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <!-- Results will be populated here -->
                                </div>
                            </div>
                            
                            <!-- Hidden input for selected member -->
                            <input type="hidden" name="member_id" id="memberIdInput">
                            
                            <!-- Selected Member Display -->
                            <div id="selectedMemberDisplay" style="display: none;">
                                <div class="p-3 bg-blue-50 border border-[#0C5587] rounded-lg mb-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-semibold text-gray-900" id="selectedMemberName"></div>
                                            <div class="text-sm text-gray-600">
                                                <span id="selectedMemberCode"></span>
                                            </div>
                                        </div>
                                        <button type="button" onclick="clearMemberSelection()" class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Info Minimal Belanja -->
                                <div class="flex items-start gap-2 p-3 bg-yellow-50 border border-yellow-300 rounded-lg text-sm">
                                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <div class="text-yellow-800">
                                        <span class="font-semibold">Diskon Otomatis 15%</span><br>
                                        Dapatkan potongan harga langsung untuk setiap belanjaan minimal <span class="font-bold">Rp 50.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product List -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    Daftar Produk
                                </h3>
                                <span class="text-sm text-gray-500" id="productCount"><?php echo e($barang->count()); ?> produk</span>
                            </div>
                            
                            <!-- Search Box -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="searchProduct" 
                                       placeholder="Cari produk..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                       oninput="searchProducts()">
                            </div>
                        </div>

                        <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2" id="productList">
                            <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-[#0C5587] transition-colors product-item cursor-pointer" 
                                 data-product-name="<?php echo e(strtolower($b->nama_barang)); ?>"
                                 onclick="toggleProductByClick(<?php echo e($b->id); ?>, event)">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <input class="w-5 h-5 rounded cursor-pointer product-checkbox" 
                                               type="checkbox" 
                                               value="<?php echo e($b->id); ?>" 
                                               id="b<?php echo e($b->id); ?>" 
                                               data-harga="<?php echo e($b->harga_jual); ?>"
                                               data-harga-beli="<?php echo e($b->harga_beli); ?>"
                                               data-nama="<?php echo e($b->nama_barang); ?>"
                                               data-stok="<?php echo e($b->stok); ?>"
                                               style="accent-color: #0C5587;"
                                               onclick="event.stopPropagation(); toggleProduct(<?php echo e($b->id); ?>);">
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">
                                            <?php echo e($b->nama_barang); ?>

                                        </div>
                                        <div class="flex items-center gap-4 mt-1 text-sm">
                                            <span class="text-lg font-bold" style="color: #0C5587;">
                                                Rp <?php echo e(number_format($b->harga_jual,0,',','.')); ?>

                                            </span>
                                            <span class="text-gray-500">
                                                Stok: <span class="font-semibold"><?php echo e($b->stok); ?></span>
                                            </span>
                                        </div>
                                        <div class="mt-3 hidden" id="qty-container-<?php echo e($b->id); ?>" onclick="event.stopPropagation()">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                            <div class="flex items-center gap-2">
                                                <button type="button" onclick="decrementQty(<?php echo e($b->id); ?>)" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold transition-colors">
                                                    -
                                                </button>
                                                <input type="number" 
                                                       id="qty-<?php echo e($b->id); ?>"
                                                       min="1" 
                                                       max="<?php echo e($b->stok); ?>" 
                                                       value="1"
                                                       class="w-20 px-3 py-2 text-center border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C5587]"
                                                       onchange="updateCart()">
                                                <button type="button" onclick="incrementQty(<?php echo e($b->id); ?>, <?php echo e($b->stok); ?>)" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold transition-colors">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Cart Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-200" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Ringkasan Transaksi
                            </h3>
                        </div>

                        <!-- Cart Items -->
                        <div class="px-6 py-4">
                            <div id="cartItems" class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500">Belum ada produk dipilih</p>
                                    <p class="text-xs text-gray-400 mt-1">Pilih produk dari daftar di samping</p>
                                </div>
                            </div>

                            <!-- Summary Details -->
                            <div class="border-t border-gray-200 pt-4 space-y-3">
                                <!-- Subtotal -->
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal <span id="subtotalItemCount" class="text-gray-500"></span></span>
                                    <span class="font-semibold text-gray-900" id="subtotal">Rp 0</span>
                                </div>
                                
                                <!-- Alert Minimal Belanja untuk Diskon Member -->
                                <div id="alertMinimalBelanja" style="display: none;">
                                    <div class="flex items-start gap-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div class="text-sm text-blue-800">
                                            <span class="font-semibold" id="alertMinimalBelanjaText"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Diskon Manual -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Diskon Manual</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-500 text-sm font-medium">Rp</span>
                                        <input type="number" 
                                               name="diskon" 
                                               id="diskonManual"
                                               value="0" 
                                               min="0"
                                               class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                               oninput="updateCart()"
                                               placeholder="0">
                                    </div>
                                </div>

                                <!-- Diskon Member (Detail) -->
                                <div id="diskonMemberDetail">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Diskon Member (<span id="diskonMemberPersenDetail">0</span>%)</span>
                                        <span class="font-semibold text-green-600" id="diskonMemberNominalDetail">Rp 0</span>
                                    </div>
                                </div>

                                <!-- Diskon Member Alert Box -->
                                <div id="diskonMemberContainer" style="display: none;">
                                    <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <div>
                                                <span class="text-sm font-medium text-green-900">Diskon Member Aktif</span>
                                                <span class="text-xs text-green-700 ml-1">(<span id="diskonMemberPersen">0</span>%)</span>
                                            </div>
                                        </div>
                                        <span class="font-bold text-green-700" id="diskonMemberNominal">- Rp 0</span>
                                    </div>
                                </div>

                                <!-- Total Diskon (Gabungan Manual + Member) -->
                                <div id="totalDiskonContainer" class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-700 font-medium">Total Diskon</span>
                                        <span class="font-bold text-red-600" id="totalDiskonDisplay">- Rp 0</span>
                                    </div>
                                </div>

                                <!-- Total Bayar -->
                                <div class="border-t border-gray-200 pt-3 mt-3">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-base font-bold text-gray-900">Total Bayar</span>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold" style="color: #0C5587;" id="totalBayar">Rp 0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="px-6 pb-6">
                            <button type="submit" 
                                    id="submitBtn"
                                    disabled
                                    class="w-full px-6 py-3 rounded-lg font-bold transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                    style="background-color: #0C5587; color: white;"
                                    onmouseover="if(!this.disabled) this.style.backgroundColor='#0884D1'"
                                    onmouseout="if(!this.disabled) this.style.backgroundColor='#0C5587'">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Buat Pesanan
                            </button>
                            
                            <p class="text-xs text-gray-500 text-center mt-3">
                                Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let selectedProducts = new Map();
    let memberDiskonPersen = 0;
    let useMember = false;
    let allMembers = [
        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        {
            id: <?php echo e($m->id); ?>,
            name: "<?php echo e($m->name); ?>",
            code: "<?php echo e($m->kode_member); ?>",
            diskon: <?php echo e($m->diskon_member ?? 0); ?>

        }<?php echo e(!$loop->last ? ',' : ''); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ];

    // Initialize on DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        // Set default state (No member)
        const btnNo = document.getElementById('btnNoMember');
        const btnYes = document.getElementById('btnYesMember');
        const memberBox = document.getElementById('memberSelectionBox');
        
        if (!btnNo || !btnYes || !memberBox) {
            console.error('Member controls not found!');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('memberDropdown');
        const searchInput = document.getElementById('searchMember');
        if (dropdown && !dropdown.contains(e.target) && e.target !== searchInput) {
            dropdown.style.display = 'none';
        }
    });

    // Toggle member usage
    function toggleMemberUsage(useMemberParam) {
        useMember = useMemberParam;
        const memberBox = document.getElementById('memberSelectionBox');
        const btnYes = document.getElementById('btnYesMember');
        const btnNo = document.getElementById('btnNoMember');
        
        if (!memberBox || !btnYes || !btnNo) {
            console.error('Elements not found!', { memberBox, btnYes, btnNo });
            return;
        }
        
        if (useMember) {
            // Show member selection
            memberBox.style.display = 'block';
            
            // Style for selected "Ya" button
            btnYes.style.borderColor = '#0C5587';
            btnYes.style.backgroundColor = '#EBF5FF';
            btnYes.style.color = '#0C5587';
            
            // Style for unselected "Tidak" button
            btnNo.style.borderColor = '#D1D5DB';
            btnNo.style.backgroundColor = 'white';
            btnNo.style.color = '#374151';
            
            // Auto-focus search input
            setTimeout(() => {
                const searchInput = document.getElementById('searchMember');
                if (searchInput) {
                    searchInput.focus();
                }
            }, 100);
        } else {
            // Hide member selection and clear
            memberBox.style.display = 'none';
            clearMemberSelection();
            
            // Style for selected "Tidak" button
            btnNo.style.borderColor = '#0C5587';
            btnNo.style.backgroundColor = '#EBF5FF';
            btnNo.style.color = '#0C5587';
            
            // Style for unselected "Ya" button
            btnYes.style.borderColor = '#D1D5DB';
            btnYes.style.backgroundColor = 'white';
            btnYes.style.color = '#374151';
        }
    }

    // Live search members (autocomplete)
    function searchMembersLive() {
        const searchText = document.getElementById('searchMember').value.toLowerCase();
        const dropdown = document.getElementById('memberDropdown');
        
        if (searchText.length === 0) {
            // Show all members when search is empty
            dropdown.innerHTML = '';
            allMembers.forEach(member => {
                dropdown.appendChild(createMemberOption(member));
            });
            dropdown.style.display = 'block';
        } else {
            // Filter members based on search
            const filtered = allMembers.filter(member => 
                member.name.toLowerCase().includes(searchText) || 
                member.code.toLowerCase().includes(searchText)
            );
            
            dropdown.innerHTML = '';
            
            if (filtered.length === 0) {
                dropdown.innerHTML = '<div class="p-3 text-sm text-gray-500 text-center">Tidak ada member ditemukan</div>';
            } else {
                filtered.forEach(member => {
                    dropdown.appendChild(createMemberOption(member));
                });
            }
            
            dropdown.style.display = 'block';
        }
    }

    // Create member option element
    function createMemberOption(member) {
        const div = document.createElement('div');
        div.className = 'p-3 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-0';
        div.innerHTML = `
            <div class="font-semibold text-gray-900">${member.name}</div>
            <div class="text-sm text-gray-600">${member.code}</div>
        `;
        div.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            selectMember(member);
        });
        return div;
    }

    // Select member from dropdown
    function selectMember(member) {
        // Set hidden input
        const memberInput = document.getElementById('memberIdInput');
        if (memberInput) {
            memberInput.value = member.id;
        } else {
            console.error('❌ memberIdInput not found!');
        }
        
        // Update display elements
        const nameEl = document.getElementById('selectedMemberName');
        const codeEl = document.getElementById('selectedMemberCode');
        const diskonEl = document.getElementById('selectedMemberDiskon');
        
        if (nameEl) nameEl.textContent = member.name;
        if (codeEl) codeEl.textContent = member.code;
        if (diskonEl) diskonEl.textContent = member.diskon;
        
        // Show selected display, hide search
        const searchContainer = document.getElementById('searchMemberContainer');
        const searchInput = document.getElementById('searchMember');
        const dropdown = document.getElementById('memberDropdown');
        const selectedDisplay = document.getElementById('selectedMemberDisplay');
        
        // Hide search container (including icon)
        if (searchContainer) {
            searchContainer.style.display = 'none';
        }
        if (searchInput) {
            searchInput.value = '';
        }
        if (dropdown) {
            dropdown.style.display = 'none';
        }
        if (selectedDisplay) {
            selectedDisplay.style.display = 'block';
        }
        
        // Update diskon
        memberDiskonPersen = parseFloat(member.diskon) || 0;
        updateCart();
    }

    // Clear member selection
    function clearMemberSelection() {
        const memberInput = document.getElementById('memberIdInput');
        const searchContainer = document.getElementById('searchMemberContainer');
        const searchInput = document.getElementById('searchMember');
        const selectedDisplay = document.getElementById('selectedMemberDisplay');
        const dropdown = document.getElementById('memberDropdown');
        
        if (memberInput) memberInput.value = '';
        
        // Show search container again (including icon)
        if (searchContainer) {
            searchContainer.style.display = 'block';
        }
        if (searchInput) {
            searchInput.value = '';
        }
        if (selectedDisplay) selectedDisplay.style.display = 'none';
        if (dropdown) dropdown.style.display = 'none';
        
        memberDiskonPersen = 0;
        updateCart();
    }

    // Search products function
    function searchProducts() {
        const searchText = document.getElementById('searchProduct').value.toLowerCase();
        const productItems = document.querySelectorAll('.product-item');
        let visibleCount = 0;

        productItems.forEach(item => {
            const productName = item.getAttribute('data-product-name');
            if (productName.includes(searchText)) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        document.getElementById('productCount').textContent = `${visibleCount} produk`;
    }

    // Toggle product by clicking anywhere on the card
    function toggleProductByClick(id, event) {
        // Ignore if clicking on input fields or buttons
        if (event.target.tagName === 'INPUT' || event.target.tagName === 'BUTTON') {
            return;
        }
        
        const checkbox = document.getElementById(`b${id}`);
        checkbox.checked = !checkbox.checked;
        toggleProduct(id);
    }

    function toggleProduct(id) {
        const checkbox = document.getElementById(`b${id}`);
        const container = document.getElementById(`qty-container-${id}`);
        const productItem = checkbox.closest('.product-item');
        const qtyInput = document.getElementById(`qty-${id}`);
        
        if (checkbox.checked) {
            container.classList.remove('hidden');
            productItem.classList.add('border-[#0C5587]', 'bg-blue-50');
            qtyInput.value = 1; // Reset to 1
            selectedProducts.set(id, {
                nama: checkbox.dataset.nama,
                harga: parseFloat(checkbox.dataset.harga),
                qty: 1
            });
        } else {
            container.classList.add('hidden');
            productItem.classList.remove('border-[#0C5587]', 'bg-blue-50');
            selectedProducts.delete(id);
            qtyInput.value = 0; // Set to 0 when unchecked
        }
        
        updateCart();
    }

    function decrementQty(id) {
        const input = document.getElementById(`qty-${id}`);
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            updateProductQty(id, parseInt(input.value));
        }
    }

    function incrementQty(id, maxStock) {
        const input = document.getElementById(`qty-${id}`);
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
            updateProductQty(id, parseInt(input.value));
        }
    }

    function updateProductQty(id, qty) {
        if (selectedProducts.has(id)) {
            selectedProducts.get(id).qty = qty;
            updateCart();
        }
    }

    function updateCart() {
        const cartItemsDiv = document.getElementById('cartItems');
        const submitBtn = document.getElementById('submitBtn');
        
        // Update quantities from inputs
        selectedProducts.forEach((product, id) => {
            const qtyInput = document.getElementById(`qty-${id}`);
            if (qtyInput) {
                product.qty = parseInt(qtyInput.value) || 1;
            }
        });

        // Update cart items display
        if (selectedProducts.size === 0) {
            cartItemsDiv.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-sm text-gray-500">Belum ada produk dipilih</p>
                    <p class="text-xs text-gray-400 mt-1">Pilih produk dari daftar di samping</p>
                </div>
            `;
            submitBtn.disabled = true;
        } else {
            let html = '';
            selectedProducts.forEach((product, id) => {
                const subtotal = product.harga * product.qty;
                html += `
                    <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-0">
                        <div class="flex-1 pr-3">
                            <div class="font-medium text-gray-900 text-sm">${product.nama}</div>
                            <div class="text-xs text-gray-500 mt-1">${product.qty} × Rp ${product.harga.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="font-semibold text-gray-900 text-sm whitespace-nowrap">
                            Rp ${subtotal.toLocaleString('id-ID')}
                        </div>
                    </div>
                `;
            });
            cartItemsDiv.innerHTML = html;
            submitBtn.disabled = false;
        }

        // Calculate totals
        let subtotal = 0;
        let totalItems = 0;
        selectedProducts.forEach(product => {
            subtotal += product.harga * product.qty;
            totalItems += product.qty;
        });

        const diskonManual = parseFloat(document.getElementById('diskonManual').value) || 0;
        
        // Member discount only applies if subtotal >= 50.000
        const minBelanjaDiskon = 50000;
        let diskonMemberNominal = 0;
        let diskonMemberApplied = false;
        
        if (memberDiskonPersen > 0 && subtotal >= minBelanjaDiskon) {
            diskonMemberNominal = subtotal * (memberDiskonPersen / 100);
            diskonMemberApplied = true;
        }
        
        const totalDiskon = diskonManual + diskonMemberNominal;
        const totalBayar = Math.max(0, subtotal - totalDiskon);

        // Update displays
        const itemCountText = totalItems > 0 ? `(${totalItems} item)` : '';
        document.getElementById('subtotalItemCount').textContent = itemCountText;
        document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
        document.getElementById('totalBayar').textContent = `Rp ${totalBayar.toLocaleString('id-ID')}`;

        // Update total diskon - SELALU tampilkan
        const totalDiskonDisplay = document.getElementById('totalDiskonDisplay');
        
        if (totalDiskonDisplay) {
            if (totalDiskon > 0) {
                totalDiskonDisplay.textContent = `- Rp ${totalDiskon.toLocaleString('id-ID')}`;
                totalDiskonDisplay.parentElement.parentElement.style.opacity = '1';
            } else {
                totalDiskonDisplay.textContent = `Rp 0`;
                totalDiskonDisplay.parentElement.parentElement.style.opacity = '0.5';
            }
        } else {
            console.error('❌ totalDiskonDisplay element not found!');
        }

        // Update member discount display - SELALU tampilkan
        const diskonMemberContainer = document.getElementById('diskonMemberContainer');
        const diskonMemberPersenDetailEl = document.getElementById('diskonMemberPersenDetail');
        const diskonMemberNominalDetailEl = document.getElementById('diskonMemberNominalDetail');
        const diskonMemberDetail = document.getElementById('diskonMemberDetail');
        const alertMinimalBelanja = document.getElementById('alertMinimalBelanja');
        const alertText = document.getElementById('alertMinimalBelanjaText');
        
        // Update diskon member detail (selalu tampil, tapi nilai berubah)
        if (diskonMemberPersenDetailEl && diskonMemberNominalDetailEl) {
            if (memberDiskonPersen > 0 && diskonMemberApplied) {
                diskonMemberPersenDetailEl.textContent = memberDiskonPersen;
                diskonMemberNominalDetailEl.textContent = `- Rp ${diskonMemberNominal.toLocaleString('id-ID')}`;
                diskonMemberDetail.style.opacity = '1';
                
                // Show green box
                if (diskonMemberContainer) {
                    diskonMemberContainer.style.display = 'block';
                    document.getElementById('diskonMemberPersen').textContent = memberDiskonPersen;
                    document.getElementById('diskonMemberNominal').textContent = `- Rp ${diskonMemberNominal.toLocaleString('id-ID')}`;
                }
                
                // Hide alert
                if (alertMinimalBelanja) alertMinimalBelanja.style.display = 'none';
            } else if (memberDiskonPersen > 0 && !diskonMemberApplied) {
                diskonMemberPersenDetailEl.textContent = memberDiskonPersen;
                diskonMemberNominalDetailEl.textContent = `Rp 0`;
                diskonMemberDetail.style.opacity = '0.5';
                
                // Hide green box
                if (diskonMemberContainer) diskonMemberContainer.style.display = 'none';
                
                // Show alert
                if (alertMinimalBelanja && alertText) {
                    const kurangBelanja = minBelanjaDiskon - subtotal;
                    alertText.textContent = `Belanja Rp ${kurangBelanja.toLocaleString('id-ID')} lagi untuk diskon ${memberDiskonPersen}%`;
                    alertMinimalBelanja.style.display = 'block';
                }
            } else {
                diskonMemberPersenDetailEl.textContent = '0';
                diskonMemberNominalDetailEl.textContent = `Rp 0`;
                diskonMemberDetail.style.opacity = '0.5';
                
                if (diskonMemberContainer) diskonMemberContainer.style.display = 'none';
                if (alertMinimalBelanja) alertMinimalBelanja.style.display = 'none';
            }
        }
    }

    // Form validation before submit
    document.getElementById('transaksiForm').addEventListener('submit', function(e) {
        if (selectedProducts.size === 0) {
            e.preventDefault();
            alert('Silakan pilih minimal 1 produk!');
            return false;
        }

        // Validate all quantities
        let hasInvalidQty = false;
        selectedProducts.forEach((product, id) => {
            const qtyInput = document.getElementById(`qty-${id}`);
            const checkbox = document.getElementById(`b${id}`);
            const maxStock = parseInt(checkbox.dataset.stok);
            
            if (!qtyInput || parseInt(qtyInput.value) < 1) {
                hasInvalidQty = true;
            }
            
            if (parseInt(qtyInput.value) > maxStock) {
                alert(`Jumlah ${product.nama} melebihi stok yang tersedia (${maxStock})!`);
                hasInvalidQty = true;
            }
        });

        if (hasInvalidQty) {
            e.preventDefault();
            return false;
        }

        // Clear existing hidden inputs
        const existingInputs = document.querySelectorAll('.dynamic-item-input');
        existingInputs.forEach(input => input.remove());

        // Generate hidden inputs HANYA untuk produk yang dipilih
        selectedProducts.forEach((product, id) => {
            const qtyInput = document.getElementById(`qty-${id}`);
            const checkbox = document.getElementById(`b${id}`);
            const qty = parseInt(qtyInput.value);
            
            // Create hidden inputs for this item
            const createHiddenInput = (name, value) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                input.className = 'dynamic-item-input';
                return input;
            };
            
            // Append to form
            const form = document.getElementById('transaksiForm');
            form.appendChild(createHiddenInput(`items[${id}][barang_id]`, id));
            form.appendChild(createHiddenInput(`items[${id}][jumlah]`, qty));
            form.appendChild(createHiddenInput(`items[${id}][harga_beli]`, checkbox.dataset.hargaBeli));
            form.appendChild(createHiddenInput(`items[${id}][harga_jual]`, checkbox.dataset.harga));
        });

        // Disable submit button to prevent double submission
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="w-5 h-5 inline-block mr-2 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/kasir/transaksi/create.blade.php ENDPATH**/ ?>