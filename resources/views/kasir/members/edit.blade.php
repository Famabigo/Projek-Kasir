@extends('layouts.app')
@section('title','Edit Member')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <h1 class="text-2xl font-bold text-white">Edit Member</h1>
            </div>
            
            <form method="POST" action="{{ route('kasir.members.update',$member) }}" class="p-6">
                @csrf 
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Member <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_member" value="{{ old('nama_member', $member->nama_member) }}" required
                        class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-opacity-50 transition-all @error('nama_member') border-red-500 @enderror" 
                        style="border-color: #B1D7F2;">
                    @error('nama_member')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        No HP
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $member->no_hp) }}"
                        class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-opacity-50 transition-all" 
                        style="border-color: #B1D7F2;">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-opacity-50 transition-all" 
                        style="border-color: #B1D7F2;">{{ old('alamat', $member->alamat) }}</textarea>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Diskon Member (%) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="diskon_member" value="{{ old('diskon_member', $member->diskon_member ?? 0) }}" 
                            min="0" max="100" step="0.01" required
                            class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-opacity-50 transition-all @error('diskon_member') border-red-500 @enderror" 
                            style="border-color: #B1D7F2;">
                        <span class="absolute right-4 top-3 text-gray-500 font-semibold">%</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Member akan mendapat diskon saat berbelanja</p>
                    @error('diskon_member')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('kasir.members.index') }}" class="flex-1 px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 font-medium transition-all text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-4 py-3 text-white rounded-lg font-medium transition-all" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
