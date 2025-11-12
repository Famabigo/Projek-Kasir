<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 11px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #0C5587;
            padding-bottom: 10px;
        }
        .header h2 { 
            color: #0C5587;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        .filter-info {
            margin: 15px 0;
            padding: 10px;
            background: #f0f0f0;
            border-radius: 5px;
            font-size: 10px;
        }
        .summary { 
            margin: 20px 0;
            padding: 15px;
            background: #EDF7FC;
            border-left: 4px solid #0C5587;
            border-radius: 5px;
        }
        .summary p {
            margin: 8px 0;
            color: #333;
        }
        .summary strong {
            color: #0C5587;
        }
        table { 
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #B1D7F2;
            padding: 10px 8px;
            text-align: left;
        }
        th { 
            background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);
            color: #0C5587;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #EDF7FC;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px solid #B1D7F2;
            text-align: right;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENJUALAN</h2>
        <p><strong>ShopEase Kasir</strong></p>
        <p>Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d M Y') }}</p>
    </div>
    
    @if(($filterMetode ?? 'all') !== 'all' || $filterPembeli !== 'all' || $barangId)
    <div class="filter-info">
        <strong>Filter yang diterapkan:</strong><br>
        @if(($filterMetode ?? 'all') === 'online')
        - Metode Pembelian: Pembelian Online<br>
        @elseif(($filterMetode ?? 'all') === 'offline')
        - Metode Pembelian: Pembelian Offline<br>
        @endif
        @if($filterPembeli === 'member')
        - Tipe Pembeli: Hanya Member<br>
        @elseif($filterPembeli === 'non-member')
        - Tipe Pembeli: Hanya Non-Member<br>
        @endif
        @if($barangId)
        - Produk: {{ \App\Models\Barang::find($barangId)->nama_barang ?? 'Unknown' }}<br>
        @endif
    </div>
    @endif
    
    <div class="summary">
        <p><strong>Total Transaksi:</strong> {{ $transaksi->count() }} transaksi</p>
        <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalOmset, 0, ',', '.') }}</p>
        <p><strong>Total Keuntungan:</strong> Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">Metode</th>
                <th style="width: 12%;">ID/Kode</th>
                <th style="width: 16%;">Tanggal</th>
                <th style="width: 14%;">Kasir</th>
                <th style="width: 14%;">Pembeli</th>
                <th style="width: 14%;" class="text-right">Total</th>
                <th style="width: 10%;" class="text-right">Diskon</th>
                <th style="width: 12%;" class="text-right">Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $index => $item)
            @php
                $isPesanan = isset($item->user);
                // Hitung keuntungan untuk pesanan online
                $keuntungan = 0;
                if ($isPesanan) {
                    foreach ($item->details as $detail) {
                        $keuntungan += ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
                    }
                } else {
                    $keuntungan = $item->keuntungan;
                }
            @endphp
            <tr>
                <td>
                    @if($isPesanan)
                        <strong style="color: #22c55e;">Online</strong>
                    @else
                        <strong style="color: #3b82f6;">Offline</strong>
                    @endif
                </td>
                <td>
                    <strong style="color: #0C5587;">
                        @if($isPesanan)
                            {{ $item->kode_pesanan }}
                        @else
                            #T-{{ $item->id }}
                        @endif
                    </strong>
                </td>
                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                <td>
                    {{ $item->kasir->name ?? '-' }}
                </td>
                <td>
                    @if($isPesanan)
                        {{ $item->user->name ?? '-' }}
                    @else
                        {{ $item->member->name ?? 'Non-Member' }}
                    @endif
                </td>
                <td class="text-right">
                    <strong>Rp {{ number_format($isPesanan ? $item->total_bayar : $item->total_harga, 0, ',', '.') }}</strong>
                </td>
                <td class="text-right">Rp {{ number_format($item->diskon ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="color: #0C5587;">
                    <strong>Rp {{ number_format($keuntungan, 0, ',', '.') }}</strong>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background: #EDF7FC; font-weight: bold;">
                <td colspan="5" style="text-align: right; color: #0C5587;">TOTAL:</td>
                <td class="text-right" style="color: #0C5587;">Rp {{ number_format($totalOmset, 0, ',', '.') }}</td>
                <td class="text-right">-</td>
                <td class="text-right" style="color: #0C5587;">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem</p>
    </div>
</body>
</html>
