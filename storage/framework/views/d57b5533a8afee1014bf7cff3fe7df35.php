
<?php $__env->startSection('title','Members'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-8" style="background-color: #EDF7FC; min-height: 100vh;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Kelola Member</h2>
                <p class="text-gray-600 text-sm mt-1">Manajemen data member dan persetujuan permohonan</p>
            </div>
            <a href="<?php echo e(route('kasir.members.create')); ?>" class="text-white px-4 py-2 rounded-lg font-medium transition-opacity hover:opacity-90 flex items-center space-x-2" style="background-color: #0C5587;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span>Tambah Member</span>
            </a>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="flex space-x-2 border-b-2 border-gray-200">
                <button onclick="showTab('members')" id="tab-members" class="tab-btn px-6 py-3 font-semibold transition-all duration-200" style="color: #0C5587; border-bottom: 3px solid #0C5587;">
                    Member Aktif
                </button>
                <button onclick="showTab('pending')" id="tab-pending" class="tab-btn px-6 py-3 font-semibold text-gray-500 hover:text-gray-700 transition-all duration-200 border-bottom-3 border-transparent">
                    Permohonan Pending
                    <?php
                        $pendingCount = \App\Models\User::where('member_status', 'pending')->count();
                    ?>
                    <?php if($pendingCount > 0): ?>
                        <span class="ml-2 px-2 py-1 text-xs font-bold text-white rounded-full" style="background: #C7E339; color: #0C5587;"><?php echo e($pendingCount); ?></span>
                    <?php endif; ?>
                </button>
            </div>
        </div>

        <!-- Tab Content: Member Aktif -->
        <div id="content-members" class="tab-content">
        <!-- Card Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Member</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode Member</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Telepon</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $approvedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3">
                                <span class="font-semibold text-sm" style="color: #0C5587;">#<?php echo e($user->id); ?></span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center space-x-3">
                                    <div class="rounded-full h-9 w-9 flex items-center justify-center text-white text-sm font-bold" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                    <span class="font-medium text-sm text-gray-900"><?php echo e($user->name); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold text-white" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);"><?php echo e($user->kode_member); ?></span>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-700"><?php echo e($user->email); ?></td>
                            <td class="px-6 py-3 text-sm text-gray-700"><?php echo e($user->no_hp ?? '-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="text-lg font-medium">Belum ada member yang disetujui</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?php echo e($members->links()); ?>

            </div>
        </div>
        </div>

        <!-- Tab Content: Permohonan Pending -->
        <div id="content-pending" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-yellow-50">
                            <tr class="border-b border-gray-200">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Ajuan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No. HP</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alamat</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                                $pendingUsers = \App\Models\User::where('member_status', 'pending')->latest()->get();
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $pendingUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-3">
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($user->created_at->format('d M Y')); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($user->created_at->format('H:i')); ?></div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="rounded-full h-9 w-9 flex items-center justify-center text-white text-sm font-bold" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                                            <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                        </div>
                                        <span class="font-medium text-sm text-gray-900"><?php echo e($user->name); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?php echo e($user->email); ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?php echo e($user->no_hp ?? '-'); ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?php echo e($user->alamat ?? '-'); ?></td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button onclick="openApproveModal(<?php echo e($user->id); ?>, '<?php echo e($user->name); ?>')" class="p-2 rounded-lg transition-colors hover:bg-green-50" title="Setujui">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                        <button onclick="openRejectModal(<?php echo e($user->id); ?>, '<?php echo e($user->name); ?>')" class="p-2 rounded-lg transition-colors hover:bg-red-50" title="Tolak">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-lg font-medium">Tidak Ada Permohonan Pending</p>
                                    <p class="text-sm text-gray-400 mt-1">Semua permohonan member sudah diproses</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Approve Member -->
<div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-fade-in">
        <div class="p-6 border-b" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
            <h3 class="text-xl font-bold text-white">Setujui Member</h3>
        </div>
        <form id="approveForm" method="POST">
            <?php echo csrf_field(); ?>
            <div class="p-6">
                <p class="text-gray-700 mb-4">Setujui permohonan member untuk <strong id="approveMemberName"></strong>?</p>
                
                <div class="p-4 rounded-lg" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                    <div class="flex items-center space-x-2 mb-2">
                        <svg class="w-5 h-5" style="color: #C7E339;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="font-bold" style="color: #0C5587;">Keuntungan Member:</span>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-1 ml-7">
                        <li>• Diskon otomatis <strong>15%</strong></li>
                        <li>• Untuk belanja minimal <strong>Rp 50.000</strong></li>
                    </ul>
                </div>
            </div>
            <div class="p-6 bg-gray-50 rounded-b-2xl flex space-x-3">
                <button type="button" onclick="closeApproveModal()" class="flex-1 px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 font-medium transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 text-white rounded-lg font-medium transition-all" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    Setujui
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reject Member -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-fade-in">
        <div class="p-6 border-b" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
            <h3 class="text-xl font-bold text-white">Tolak Member</h3>
        </div>
        <form id="rejectForm" method="POST">
            <?php echo csrf_field(); ?>
            <div class="p-6">
                <p class="text-gray-700 mb-4">Tolak permohonan member untuk <strong id="rejectMemberName"></strong>?</p>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Penolakan
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea name="reject_reason" rows="3" required
                        class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-opacity-50 transition-all" 
                        style="border-color: #B1D7F2;"
                        placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
            </div>
            <div class="p-6 bg-gray-50 rounded-b-2xl flex space-x-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 font-medium transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active styling from all tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.style.color = '#6B7280';
        btn.style.borderBottom = '3px solid transparent';
    });
    
    // Show selected content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active styling to selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.style.color = '#0C5587';
    activeTab.style.borderBottom = '3px solid #0C5587';
}

function openApproveModal(userId, userName) {
    document.getElementById('approveMemberName').textContent = userName;
    document.getElementById('approveForm').action = `/kasir/member-approval/${userId}/approve`;
    document.getElementById('approveModal').classList.remove('hidden');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
}

function openRejectModal(userId, userName) {
    document.getElementById('rejectMemberName').textContent = userName;
    document.getElementById('rejectForm').action = `/kasir/member-approval/${userId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('approveModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeApproveModal();
});

document.getElementById('rejectModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/kasir/members/index.blade.php ENDPATH**/ ?>