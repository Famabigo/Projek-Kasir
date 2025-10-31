@extends('layouts.app')
@section('title','Laporan Barang')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold" style="color: #0C5587;">Laporan Barang</h2>
            <p class="text-gray-600 mt-2">Laporkan barang expired atau stok menipis ke admin</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg border-2 border-green-400 bg-green-50 text-green-800">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 rounded-lg border-2 border-red-400 bg-red-50 text-red-800">
            {{ session('error') }}
        </div>
        @endif

        <!-- Tabs -->
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button onclick="showTab('expired')" id="tab-expired" class="tab-button py-4 px-1 border-b-2 font-medium text-sm active">
                    Barang Expired
                </button>
                <button onclick="showTab('stok')" id="tab-stok" class="tab-button py-4 px-1 border-b-2 font-medium text-sm">
                    Stok Menipis
                </button>
                <button onclick="showTab('riwayat')" id="tab-riwayat" class="tab-button py-4 px-1 border-b-2 font-medium text-sm">
                    Riwayat Laporan
                </button>
            </nav>
        </div>

        <!-- Tab Content: Barang Expired -->
        <div id="content-expired" class="tab-content">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #ffffff 100%);">
                    <h3 class="text-lg font-bold" style="color: #0C5587;">Barang Expired atau Akan Expired (3 Bulan)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama Barang</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Expired</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($barangExpired as $b)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">{{ $b->nama_barang }}</div>
                                    <div class="text-sm text-gray-500">{{ $b->kategori }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $b->stok < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $b->stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $isExpired = $b->expired_at->isPast();
                                        $daysLeft = now()->diffInDays($b->expired_at, false);
                                    @endphp
                                    <div class="text-sm">
                                        {{ $b->expired_at->format('d M Y') }}
                                    </div>
                                    @if($isExpired)
                                        <span class="text-xs text-red-600 font-semibold">Sudah Expired!</span>
                                    @else
                                        <span class="text-xs text-orange-600 font-semibold">{{ ceil($daysLeft) }} hari lagi</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($isExpired)
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-semibold">Expired</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-800 font-semibold">Akan Expired</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="openLaporModal({{ $b->id }}, '{{ $b->nama_barang }}', 'expired')" 
                                        class="px-4 py-2 rounded-lg text-white text-sm font-medium transition-all"
                                        style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        Laporkan
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <p class="text-lg">Tidak ada barang yang expired atau akan expired</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Content: Stok Menipis -->
        <div id="content-stok" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #ffffff 100%);">
                    <h3 class="text-lg font-bold" style="color: #0C5587;">Barang dengan Stok Menipis (< 10)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama Barang</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Harga Jual</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($barangStokMenipis as $b)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">{{ $b->nama_barang }}</div>
                                    <div class="text-sm text-gray-500">{{ $b->kategori }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                        {{ $b->stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-green-600">Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="openLaporModal({{ $b->id }}, '{{ $b->nama_barang }}', 'stok_menipis')" 
                                        class="px-4 py-2 rounded-lg text-white text-sm font-medium transition-all"
                                        style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        Laporkan
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <p class="text-lg">Tidak ada barang dengan stok menipis</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Content: Riwayat Laporan -->
        <div id="content-riwayat" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #ffffff 100%);">
                    <h3 class="text-lg font-bold" style="color: #0C5587;">Riwayat Laporan Saya</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($riwayatLaporan as $lap)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $lap->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">{{ $lap->barang->nama_barang }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($lap->tipe === 'expired')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-semibold">Expired</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-800 font-semibold">Stok Menipis</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $lap->keterangan ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($lap->status === 'pending')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-semibold">Menunggu</span>
                                    @elseif($lap->status === 'dilihat')
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">Dilihat</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <p class="text-lg">Belum ada riwayat laporan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($riwayatLaporan->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $riwayatLaporan->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Laporan -->
<div id="laporModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold" style="color: #0C5587;">Buat Laporan</h3>
        </div>
        <form action="{{ route('kasir.laporan-barang.store') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="barang_id" id="modal_barang_id">
            <input type="hidden" name="tipe" id="modal_tipe">
            
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Barang</label>
                <input type="text" id="modal_barang_nama" readonly class="w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Keterangan (Opsional)</label>
                <textarea name="keterangan" rows="3" class="w-full px-4 py-2 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all" style="border-color: #B1D7F2;" placeholder="Tambahkan catatan jika diperlukan"></textarea>
            </div>

            <div class="flex items-center space-x-3">
                <button type="submit" class="flex-1 px-4 py-3 rounded-lg text-white font-bold transition-all" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                    Kirim Laporan
                </button>
                <button type="button" onclick="closeLaporModal()" class="px-4 py-3 rounded-lg border-2 font-bold transition-all" style="border-color: #B1D7F2; color: #0C5587;">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.tab-button {
    border-color: transparent;
    color: #6b7280;
    transition: all 0.2s;
}
.tab-button.active {
    border-color: #0C5587;
    color: #0C5587;
}
</style>

<script>
function showTab(tab) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    // Remove active from all buttons
    document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));
    
    // Show selected content
    document.getElementById('content-' + tab).classList.remove('hidden');
    // Add active to selected button
    document.getElementById('tab-' + tab).classList.add('active');
}

function openLaporModal(barangId, barangNama, tipe) {
    document.getElementById('modal_barang_id').value = barangId;
    document.getElementById('modal_barang_nama').value = barangNama;
    document.getElementById('modal_tipe').value = tipe;
    document.getElementById('laporModal').classList.remove('hidden');
    document.getElementById('laporModal').classList.add('flex');
}

function closeLaporModal() {
    document.getElementById('laporModal').classList.add('hidden');
    document.getElementById('laporModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('laporModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLaporModal();
    }
});
</script>
@endsection
