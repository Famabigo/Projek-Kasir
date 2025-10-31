@extends('layouts.app')
@section('title','Edit Pengaturan')
@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-3">
                <a href="{{ route('admin.settings.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Edit Pengaturan</h2>
            </div>
            <p class="text-gray-600">Ubah nilai konfigurasi sistem</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Setting Key (Read Only) -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-2" style="color: #0C5587;">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            Kunci Pengaturan
                        </label>
                        <input type="text" value="{{ $setting->key }}" readonly 
                            class="w-full px-4 py-3 rounded-lg border-2 bg-gray-50 text-gray-600 cursor-not-allowed"
                            style="border-color: #B1D7F2;">
                    </div>

                    <!-- Setting Description (if exists) -->
                    @if($setting->description)
                    <div class="mb-6 p-4 rounded-lg" style="background: #EDF7FC; border: 2px solid #B1D7F2;">
                        <p class="text-sm" style="color: #0C5587;">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            {{ $setting->description }}
                        </p>
                    </div>
                    @endif

                    <!-- Setting Value -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold mb-2" style="color: #0C5587;">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Nilai Pengaturan
                        </label>
                        <textarea name="value" rows="4" 
                            class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all @error('value') border-red-500 @enderror"
                            style="border-color: #B1D7F2;"
                            placeholder="Masukkan nilai pengaturan...">{{ old('value', $setting->value) }}</textarea>
                        @error('value')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center space-x-3">
                        <button type="submit" 
                            class="flex-1 px-6 py-3 rounded-lg text-white font-bold transition-all hover:shadow-lg"
                            style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.settings.index') }}" 
                            class="px-6 py-3 rounded-lg border-2 font-bold transition-all hover:shadow"
                            style="border-color: #B1D7F2; color: #0C5587;">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 p-4 rounded-lg border-2" style="background: #fef3c7; border-color: #fbbf24;">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold text-yellow-800 mb-1">Perhatian!</p>
                    <p class="text-sm text-yellow-700">Pastikan Anda memahami pengaturan ini sebelum mengubahnya. Perubahan yang salah dapat mempengaruhi fungsi sistem.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
