<section>
    <p class="text-sm text-gray-600 mb-6">
        Perbarui informasi profil dan alamat email Anda.
    </p>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                value="{{ old('name', $user->name) }}" 
                required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                style="border-color: #B1D7F2;">
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Email</label>
            <input id="email" name="email" type="email" 
                value="{{ old('email', $user->email) }}" 
                required autocomplete="username"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                style="border-color: #B1D7F2;">
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                class="px-6 py-3 rounded-lg text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>
