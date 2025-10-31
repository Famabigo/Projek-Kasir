@extends('layouts.app')
@section('title','Persetujuan Member')
@section('content')
<div class="w-full max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-2" style="color: #0C5587;">Persetujuan Member</h2>
        <p class="text-gray-600">Kelola permohonan member dari pelanggan</p>
    </div>

    <!-- Pending Members Section -->
    <div class="bg-white rounded-xl shadow-sm border-2 p-6 mb-6" style="border-color: #B1D7F2;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800">Permohonan Pending</h3>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                    {{ $pendingMembers->count() }} Permohonan
                </span>
            </div>

            @if($pendingMembers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal Ajuan</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Email</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">No. HP</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Alamat</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingMembers as $member)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4 text-sm text-gray-600">
                                        {{ $member->member_request_at->format('d M Y') }}<br>
                                        <span class="text-xs text-gray-500">{{ $member->member_request_at->format('H:i') }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="font-semibold text-gray-800">{{ $member->name }}</div>
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $member->email }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $member->no_hp }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600 max-w-xs">
                                        <div class="line-clamp-2" title="{{ $member->alamat }}">{{ $member->alamat }}</div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Approve Button -->
                                            <form action="{{ route(auth()->user()->role . '.member-approval.approve', $member->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Setujui permohonan member dari {{ $member->name }}?')" class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-semibold transition-colors flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Setuju
                                                </button>
                                            </form>

                                            <!-- Reject Button (triggers modal) -->
                                            <button onclick="openRejectModal({{ $member->id }}, '{{ $member->name }}')" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-colors flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Tolak
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-600 mb-1">Tidak Ada Permohonan Pending</h3>
                    <p class="text-gray-500">Semua permohonan member telah diproses</p>
                </div>
            @endif
        </div>

        <!-- Approved Members Section -->
        <div class="bg-white rounded-xl shadow-sm border-2 border-light-blue p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800">Member Aktif</h3>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                    {{ $approvedMembers->total() }} Member
                </span>
            </div>

            @if($approvedMembers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Kode Member</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Email</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">No. HP</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tgl. Disetujui</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Disetujui Oleh</th>
                                @if(auth()->user()->role === 'admin')
                                    <th class="text-center py-3 px-4 font-semibold text-gray-700">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($approvedMembers as $member)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <span class="font-mono font-bold text-primary">{{ $member->kode_member }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="font-semibold text-gray-800">{{ $member->name }}</div>
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $member->email }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $member->no_hp }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">
                                        {{ $member->member_approved_at->format('d M Y') }}
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">
                                        {{ $member->approvedBy ? $member->approvedBy->name : '-' }}
                                    </td>
                                    @if(auth()->user()->role === 'admin')
                                        <td class="py-3 px-4">
                                            <div class="flex items-center justify-center">
                                                <form action="{{ route('admin.member-approval.revoke', $member->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Cabut keanggotaan {{ $member->name }}? Ini akan menghapus status member mereka.')" class="px-3 py-1.5 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-sm font-semibold transition-colors flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                        </svg>
                                                        Cabut
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $approvedMembers->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-600 mb-1">Belum Ada Member Aktif</h3>
                    <p class="text-gray-500">Member yang disetujui akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800">Tolak Permohonan Member</h3>
                <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <p class="text-gray-600 mb-4">Anda akan menolak permohonan member dari:</p>
                    <div class="p-3 bg-gray-50 rounded-lg mb-4">
                        <p class="font-semibold text-gray-800" id="rejectMemberName"></p>
                    </div>
                    
                    <label for="reject_reason" class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea 
                        name="reject_reason" 
                        id="reject_reason" 
                        rows="4" 
                        required
                        maxlength="500"
                        placeholder="Masukkan alasan penolakan..."
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-500/20 transition-all"></textarea>
                    <p class="text-sm text-gray-500 mt-1">Alasan ini akan dilihat oleh pemohon</p>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Tolak Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(memberId, memberName) {
            const modal = document.getElementById('rejectModal');
            const form = document.getElementById('rejectForm');
            const nameDisplay = document.getElementById('rejectMemberName');
            
            // Set form action
            const role = '{{ auth()->user()->role }}';
            form.action = `/${role}/member-approval/${memberId}/reject`;
            
            // Set member name
            nameDisplay.textContent = memberName;
            
            // Clear textarea
            document.getElementById('reject_reason').value = '';
            
            // Show modal
            modal.classList.remove('hidden');
        }

        function closeRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRejectModal();
            }
        });
    </script>
</div>
@endsection
