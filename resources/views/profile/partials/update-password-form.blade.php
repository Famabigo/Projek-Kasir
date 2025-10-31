<section>
    <p class="text-sm text-gray-600 mb-6">
        Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                autocomplete="current-password"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password', 'updatePassword') border-red-500 @enderror"
                style="border-color: #B1D7F2;">
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Password Baru</label>
            <input id="update_password_password" name="password" type="password" 
                autocomplete="new-password"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password', 'updatePassword') border-red-500 @enderror"
                style="border-color: #B1D7F2;">
            @error('password', 'updatePassword')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                autocomplete="new-password"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password_confirmation', 'updatePassword') border-red-500 @enderror"
                style="border-color: #B1D7F2;">
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                class="px-6 py-3 rounded-lg text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                Ubah Password
            </button>
        </div>
    </form>
</section>
