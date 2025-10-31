<?php $__env->startSection('title', 'Profil Saya'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold" style="color: #0C5587;">Profil Saya</h1>
        <p class="text-gray-600 mt-2">Kelola informasi profil dan keamanan akun Anda</p>
    </div>

    <?php if(session('status') === 'profile-updated'): ?>
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md animate-fade-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Profil berhasil diperbarui!
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('status') === 'password-updated'): ?>
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md animate-fade-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Password berhasil diperbarui!
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                    <div class="flex flex-col items-center text-white">
                        <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center mb-4 shadow-lg">
                            <span class="text-4xl font-bold" style="color: #0C5587;">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </span>
                        </div>
                        <h3 class="text-xl font-bold mb-1"><?php echo e(Auth::user()->name); ?></h3>
                        <p class="text-blue-100 text-sm mb-4"><?php echo e(Auth::user()->email); ?></p>
                        <span class="px-4 py-1 bg-white bg-opacity-20 rounded-full text-xs font-semibold">
                            <?php echo e(ucfirst(Auth::user()->role)); ?>

                        </span>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 mr-3" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Bergabung <?php echo e(Auth::user()->created_at->format('d M Y')); ?>

                    </div>
                    <?php if(Auth::user()->role === 'pembeli' && Auth::user()->member_status === 'approved'): ?>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            Member: <?php echo e(Auth::user()->kode_member); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Update Profile Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-4" style="color: #0C5587;">Informasi Profil</h2>
                <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-4" style="color: #0C5587;">Ubah Password</h2>
                <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-xl shadow-md p-6 border-2 border-red-200">
                <h2 class="text-xl font-bold mb-4 text-red-600">Hapus Akun</h2>
                <?php echo $__env->make('profile.partials.delete-user-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/profile/edit.blade.php ENDPATH**/ ?>