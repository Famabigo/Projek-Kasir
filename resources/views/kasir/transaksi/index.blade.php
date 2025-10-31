@extends('layouts.app')
@section('title','Transaksi')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Pesanan Pembeli</h2>
                <p class="text-gray-600 mt-2">Daftar pesanan dari pembeli online</p>
            </div>
        </div>

        <!-- Card Table -->
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode Pesanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Detail</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Waktu Pesan</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pesanan as $p)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <span class="font-semibold" style="color: #0C5587;">{{ $p->kode_pesanan }}</span>
                                    <div class="text-xs text-gray-500 mt-1">{{ $p->user->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($p->status === 'menunggu')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>
                                @elseif($p->status === 'diproses')
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Diproses</span>
                                @elseif($p->status === 'siap_diambil')
                                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">Siap Diambil</span>
                                    @php
                                        $p->updateDenda();
                                    @endphp
                                    @if($p->isTelat())
                                        <div class="mt-1">
                                            <span class="bg-red-100 text-red-800 px-2 py-0.5 rounded text-xs font-medium">⚠️ Telat {{ $p->hari_telat }} hari</span>
                                        </div>
                                    @endif
                                @elseif($p->status === 'selesai')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                                    @if($p->denda_telat > 0)
                                        <div class="mt-1 text-xs text-red-600">Denda: Rp {{ number_format($p->denda_telat, 0, ',', '.') }}</div>
                                    @endif
                                @elseif($p->status === 'dibatalkan')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="text-gray-700">{{ $p->details->count() }} item</div>
                                <div class="text-xs font-medium text-blue-600">Ambil: {{ $p->waktu_ambil->format('d M, H:i') }}</div>
                                @if($p->jadwal_ambil)
                                    <div class="text-xs text-gray-500">Siap: {{ $p->jadwal_ambil->format('d M, H:i') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-green-600">Rp {{ number_format($p->total_bayar,0,',','.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $p->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="showDetailModal({{ $p->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>Detail</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="text-lg font-medium">Belum ada pesanan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $pesanan->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pesanan -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 text-white px-6 py-4 flex items-center justify-between" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
            <h3 class="text-xl font-bold">Detail Pesanan</h3>
            <button onclick="closeDetailModal()" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="p-6">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
    async function showDetailModal(pesananId) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modalContent.innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-b-2 mx-auto" style="border-color: #0C5587;"></div><p class="mt-4 text-gray-500">Memuat...</p></div>';
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/detail`);
            const data = await response.json();
            
            let itemsHtml = '';
            data.details.forEach(item => {
                itemsHtml += `
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">${item.barang.nama_barang}</p>
                            <p class="text-sm text-gray-500">${item.jumlah} x Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                        </div>
                        <p class="font-semibold text-gray-800">Rp ${parseInt(item.subtotal).toLocaleString('id-ID')}</p>
                    </div>
                `;
            });
            
            let statusBadge = '';
            if (data.pesanan.status === 'menunggu') {
                statusBadge = '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Menunggu</span>';
            } else if (data.pesanan.status === 'diproses') {
                statusBadge = '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Diproses</span>';
            } else if (data.pesanan.status === 'siap_diambil') {
                statusBadge = '<span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Siap Diambil</span>';
            } else if (data.pesanan.status === 'selesai') {
                statusBadge = '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Selesai</span>';
            } else if (data.pesanan.status === 'dibatalkan') {
                statusBadge = '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">Dibatalkan</span>';
            }
            
            modalContent.innerHTML = `
                <div class="space-y-6">
                    <!-- Info Pesanan -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Pesanan</p>
                            <p class="font-bold text-lg" style="color: #0C5587;">${data.pesanan.kode_pesanan}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <div class="mt-1">${statusBadge}</div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pembeli</p>
                            <p class="font-medium text-gray-800">${data.pesanan.user.name}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Waktu Pengambilan</p>
                            <p class="font-medium text-gray-800">${data.pesanan.waktu_ambil_formatted}</p>
                        </div>
                    </div>

                    ${data.pesanan.catatan ? `
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-blue-800 mb-1">Catatan:</p>
                        <p class="text-sm text-blue-700">${data.pesanan.catatan}</p>
                    </div>
                    ` : ''}

                    <!-- Items -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">Detail Produk</h4>
                        <div class="space-y-2">
                            ${itemsHtml}
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t-2 border-gray-300 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp ${parseInt(data.pesanan.total_harga).toLocaleString('id-ID')}</span>
                        </div>
                        ${data.pesanan.diskon > 0 ? `
                        <div class="flex justify-between items-center mb-2 text-green-600">
                            <span>Diskon</span>
                            <span>- Rp ${parseInt(data.pesanan.diskon).toLocaleString('id-ID')}</span>
                        </div>
                        ` : ''}
                        <div class="flex justify-between items-center text-lg font-bold" style="color: #0C5587;">
                            <span>Total Bayar</span>
                            <span>Rp ${parseInt(data.pesanan.total_bayar).toLocaleString('id-ID')}</span>
                        </div>
                    </div>

                    <!-- Info Waktu Pengambilan -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="font-semibold text-blue-800 mb-1">Jadwal Ambil (Pilihan Pembeli)</p>
                                <p class="text-blue-700">${data.pesanan.waktu_ambil_formatted}</p>
                                ${data.pesanan.jadwal_ambil ? `
                                <p class="text-gray-600 text-sm mt-2">Barang siap sejak: ${data.pesanan.jadwal_ambil_formatted}</p>
                                ` : ''}
                                ${data.pesanan.is_telat ? `
                                <div class="mt-3 bg-red-100 border border-red-300 rounded p-3">
                                    <p class="text-red-800 font-semibold text-sm">⚠️ TERLAMBAT ${data.pesanan.hari_telat} HARI</p>
                                    <p class="text-red-700 text-sm mt-1">Denda: Rp ${parseInt(data.pesanan.denda_telat).toLocaleString('id-ID')}</p>
                                    <p class="text-red-600 text-xs mt-1">Denda Rp 3.000/hari dihitung dari jadwal ambil pembeli</p>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>

                    ${data.pesanan.tanggal_diambil ? `
                    <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="font-semibold text-green-800">Barang Sudah Diambil</p>
                                <p class="text-green-700 text-sm">${data.pesanan.tanggal_diambil_formatted}</p>
                                ${data.pesanan.denda_telat > 0 ? `
                                <p class="text-red-700 text-sm mt-1">Denda keterlambatan: Rp ${parseInt(data.pesanan.denda_telat).toLocaleString('id-ID')}</p>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                    ` : ''}

                    <!-- Actions -->
                    ${data.pesanan.status === 'menunggu' ? `
                    <div class="flex space-x-3">
                        <button onclick="updateStatus(${data.pesanan.id}, 'diproses')" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors">
                            Proses Pesanan
                        </button>
                        <button onclick="updateStatus(${data.pesanan.id}, 'dibatalkan')" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-medium transition-colors">
                            Batalkan
                        </button>
                    </div>
                    ` : ''}
                    
                    ${data.pesanan.status === 'diproses' ? `
                    <div class="space-y-3">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800 mb-3"><strong>Set Jadwal Pengambilan</strong></p>
                            <input type="datetime-local" id="jadwalAmbil${data.pesanan.id}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <button onclick="setJadwalAmbil(${data.pesanan.id})" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-medium transition-colors">
                            Set Jadwal & Siap Diambil
                        </button>
                    </div>
                    ` : ''}
                    
                    ${data.pesanan.status === 'siap_diambil' ? `
                    <div class="space-y-3">
                        ${data.pesanan.is_telat ? `
                        <div class="bg-red-50 border-2 border-red-300 rounded-lg p-4">
                            <p class="text-red-800 font-semibold mb-2">⚠️ Pesanan Terlambat ${data.pesanan.hari_telat} Hari</p>
                            <p class="text-red-700 text-sm">Denda: <strong>Rp ${parseInt(data.pesanan.denda_telat).toLocaleString('id-ID')}</strong></p>
                            <p class="text-red-600 text-xs mt-2">Total yang harus dibayar: <strong>Rp ${parseInt(data.pesanan.total_bayar + data.pesanan.denda_telat).toLocaleString('id-ID')}</strong></p>
                        </div>
                        ` : `
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <p class="text-green-800 text-sm">✅ Pesanan tepat waktu, tidak ada denda</p>
                        </div>
                        `}
                        <button onclick="konfirmasiPengambilan(${data.pesanan.id})" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors">
                            Konfirmasi Pengambilan Barang
                        </button>
                    </div>
                    ` : ''}
                </div>
            `;
        } catch (error) {
            modalContent.innerHTML = '<div class="text-center py-8 text-red-500">Gagal memuat data pesanan</div>';
        }
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    async function updateStatus(pesananId, status) {
        if (!confirm(`Yakin ingin mengubah status pesanan menjadi ${status}?`)) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Status pesanan berhasil diupdate');
                location.reload();
            } else {
                alert(result.message || 'Gagal mengubah status');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }

    async function setJadwalAmbil(pesananId) {
        const jadwalInput = document.getElementById(`jadwalAmbil${pesananId}`);
        const jadwal = jadwalInput.value;
        
        if (!jadwal) {
            alert('Silakan pilih jadwal pengambilan terlebih dahulu');
            return;
        }
        
        // Validasi jadwal harus di masa depan
        const jadwalDate = new Date(jadwal);
        const now = new Date();
        if (jadwalDate <= now) {
            alert('Jadwal pengambilan harus di masa depan');
            return;
        }
        
        if (!confirm('Set jadwal pengambilan dan ubah status menjadi "Siap Diambil"?')) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/set-jadwal-ambil`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ jadwal_ambil: jadwal })
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Jadwal pengambilan berhasil diatur!');
                location.reload();
            } else {
                alert(result.message || 'Gagal mengatur jadwal');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }

    async function konfirmasiPengambilan(pesananId) {
        if (!confirm('Konfirmasi bahwa barang sudah diambil oleh pembeli?')) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/konfirmasi-pengambilan`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                let message = result.message;
                if (result.denda > 0) {
                    message += `\n\nDenda keterlambatan: Rp ${parseInt(result.denda).toLocaleString('id-ID')}`;
                    message += `\nTerlambat: ${result.hari_telat} hari`;
                }
                alert(message);
                location.reload();
            } else {
                alert(result.message || 'Gagal mengkonfirmasi pengambilan');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }
</script>

@endsection
