<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                Nama Lengkap
            </label>
            <input id="name" name="name" type="text" autocomplete="name" required autofocus
                placeholder="Masukkan nama lengkap"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0884D1] focus:border-transparent transition-all"
                value="{{ old('name') }}">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
            <input id="password" name="password" type="password" autocomplete="new-password" required
                placeholder="Minimal 8 karakter"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0884D1] focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                Konfirmasi Password
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                placeholder="Masukkan password kembali"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0884D1] focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start">
            <input id="terms" name="terms" type="checkbox" required
                class="h-4 w-4 mt-1 rounded border-gray-300 focus:ring-2 focus:ring-[#0884D1]" style="color: #0C5587;">
            <label for="terms" class="ml-2 block text-sm text-gray-600">
                Saya setuju dengan <a href="#" class="font-medium hover:underline" style="color: #0884D1;">Syarat & Ketentuan</a> dan <a href="#" class="font-medium hover:underline" style="color: #0884D1;">Kebijakan Privasi</a>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 rounded-lg text-base font-semibold text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Daftar Sekarang
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

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold hover:underline ml-1" style="color: #0884D1;">
                    Masuk sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

                <span>Daftar Sekarang</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </span>
        </button>

        <!-- Login Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold hover:underline transition-colors" style="color: #0884D1;">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>