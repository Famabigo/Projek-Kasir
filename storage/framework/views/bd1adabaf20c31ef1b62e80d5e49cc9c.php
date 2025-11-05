<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>ShopEase - <?php echo e(request()->is('register') ? 'Daftar' : 'Login'); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .menu-overlay {
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(12, 85, 135, 0.95) 0%, rgba(8, 132, 209, 0.95) 100%);">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0">
                    <img src="<?php echo e(asset('images/auth-bg.webp')); ?>" alt="ShopEase Background" class="w-full h-full object-cover opacity-50">
                </div>
                
                <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                    <div class="max-w-md">
                        <div class="flex items-center space-x-3 mb-8">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                                <svg class="w-7 h-7" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold">ShopEase</span>
                        </div>
                        <h1 class="text-4xl font-bold mb-4">Selamat Datang di ShopEase</h1>
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
                            <span class="text-2xl font-bold" style="color: #0C5587;">ShopEase</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            <?php if(request()->is('register')): ?>
                                Buat Akun Baru
                            <?php else: ?>
                                Masuk ke Akun
                            <?php endif; ?>
                        </h2>
                        <p class="text-gray-600">
                            <?php if(request()->is('register')): ?>
                                Daftar untuk mulai berbelanja
                            <?php else: ?>
                                Selamat datang kembali! Silakan masuk
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <?php echo e($slot); ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\laragon\www\kasir\resources\views/layouts/guest.blade.php ENDPATH**/ ?>