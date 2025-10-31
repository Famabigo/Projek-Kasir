<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                Alamat Email
            </label>
            <input id="email" name="email" type="email" autocomplete="email" required
                placeholder="nama@email.com"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0884D1] focus:border-transparent transition-all"
                value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                Password
            </label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                placeholder="Masukkan password"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0884D1] focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 focus:ring-2 focus:ring-[#0884D1]" style="color: #0C5587;">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                    Ingat saya
                </label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium hover:underline" style="color: #0884D1;">
                        Lupa password?
                    </a>
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 rounded-lg text-base font-semibold text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </button>
        </div>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">Atau</span>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold hover:underline ml-1" style="color: #0884D1;">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
