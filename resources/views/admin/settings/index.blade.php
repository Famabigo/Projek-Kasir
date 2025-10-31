@extends('layouts.app')
@section('title','Pengaturan')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold" style="color: #0C5587;">Pengaturan Sistem</h2>
            <p class="text-gray-600 mt-2">Kelola konfigurasi aplikasi kasir</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg border-2 flex items-center space-x-3 animate-slide-down" style="background: #C7E339; border-color: #0C5587;">
            <svg class="w-6 h-6 flex-shrink-0" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-semibold" style="color: #0C5587;">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Settings Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($settings as $setting)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold mb-1" style="color: #0C5587;">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</h3>
                            <p class="text-sm text-gray-500">{{ $setting->description ?? 'Konfigurasi sistem' }}</p>
                        </div>
                        <div class="p-3 rounded-lg" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                            <svg class="w-6 h-6" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="mb-4 p-4 rounded-lg bg-gray-50 border border-gray-200">
                        <p class="text-sm text-gray-500 mb-1">Nilai Saat Ini:</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $setting->value ?? '-' }}</p>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('admin.settings.edit', $setting->id) }}" 
                            class="flex-1 px-4 py-2 rounded-lg text-white font-medium text-center transition-all hover:shadow-lg"
                            style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-12 text-center">
                    <div class="mx-auto w-24 h-24 rounded-full flex items-center justify-center mb-4" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                        <svg class="w-12 h-12" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2" style="color: #0C5587;">Belum Ada Pengaturan</h3>
                    <p class="text-gray-500">Pengaturan sistem akan muncul di sini</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
@keyframes slideDown {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-slide-down {
    animation: slideDown 0.3s ease-out;
}
</style>

<script>
// Auto hide success messages after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.animate-slide-down');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.remove();
        }, 500);
    });
}, 5000);
</script>
@endsection
