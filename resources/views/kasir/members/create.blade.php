@extends('layouts.app')
@section('title','Tambah Member Baru')
@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Tambah Member Baru</h2>
                <p class="text-gray-600 mt-2">Daftarkan member baru secara langsung</p>
            </div>
            <a href="{{ route('kasir.members.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2 border-2 border-gray-300 hover:border-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-red-800 font-semibold mb-2">Terdapat kesalahan:</h3>
                        <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                <h3 class="text-lg font-bold flex items-center" style="color: #0C5587;">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Member
                </h3>
            </div>

            <!-- Card Body -->
            <form method="POST" action="{{ route('kasir.members.store') }}" class="p-6">
                @csrf
                
                <div class="space-y-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none"
                                placeholder="Contoh: Ahmad Budiman">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Masukkan nama lengkap sesuai identitas</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none"
                                placeholder="contoh@email.com">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Email akan digunakan untuk login</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none"
                                placeholder="Minimal 8 karakter">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter untuk keamanan</p>
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor HP/WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required
                                class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none"
                                placeholder="08123456789">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: 08xxxxxxxxxx</p>
                    </div>

                    <!-- Alamat Lengkap -->
                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 left-0 pl-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <textarea id="alamat" name="alamat" rows="4" required
                                class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none resize-none"
                                placeholder="Jl. Contoh No. 123, RT/RW 01/02, Kelurahan, Kecamatan, Kota, Kode Pos">{{ old('alamat') }}</textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Masukkan alamat lengkap termasuk RT/RW dan kode pos</p>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-800 mb-1">Keuntungan Member VIP</h4>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li>✅ Diskon otomatis 15% untuk belanja minimal Rp 50.000</li>
                                    <li>✅ Promo eksklusif member</li>
                                    <li>✅ Layanan prioritas</li>
                                    <li>✅ Kode member otomatis dibuat setelah pendaftaran</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('kasir.members.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 text-white rounded-lg font-semibold shadow-lg transition-all duration-200 flex items-center space-x-2" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Simpan Member</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Card -->
        <div class="mt-6 bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #C7E339 0%, #a8c72a 100%);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-800 mb-2">Tips Pendaftaran</h3>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            <span>Pastikan data yang dimasukkan akurat dan sesuai identitas</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            <span>Email harus unik dan belum terdaftar sebelumnya</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            <span>Nomor HP akan digunakan untuk notifikasi promo dan penawaran</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            <span>Member akan langsung aktif dan mendapat kode member otomatis</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(8, 132, 209, 0.1);
    }
    
    button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(12, 85, 135, 0.3);
    }
</style>
@endsection
