<section>
    <p class="text-sm text-gray-600 mb-6">
        Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.
    </p>

    <button type="button" 
        onclick="document.getElementById('deleteModal').classList.remove('hidden')"
        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold shadow-lg transition-colors">
        Hapus Akun
    </button>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <h2 class="text-xl font-bold text-center mb-2 text-gray-900">
                    Hapus Akun?
                </h2>

                <p class="text-sm text-gray-600 text-center mb-6">
                    Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Masukkan password Anda untuk mengonfirmasi.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold mb-2 text-gray-700">Password</label>
                        <input id="password" name="password" type="password" 
                            placeholder="Masukkan password Anda"
                            required
                            class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-red-500 @error('password', 'userDeletion') border-red-500 @enderror"
                            style="border-color: #FCA5A5;">
                        @error('password', 'userDeletion')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" 
                            onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                            class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors">
                            Ya, Hapus Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
        <script>
            document.getElementById('deleteModal').classList.remove('hidden');
        </script>
    @endif
</section>
