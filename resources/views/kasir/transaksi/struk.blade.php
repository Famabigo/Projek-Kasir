<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Transaksi #{{ $transaksi->id }}</title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 12px; margin: 20px; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .header h2 { margin: 5px 0; }
        .info { margin: 10px 0; }
        .info p { margin: 3px 0; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        table td { padding: 5px 0; }
        .item-row { border-bottom: 1px dotted #ccc; }
        .total-section { border-top: 2px dashed #000; margin-top: 10px; padding-top: 10px; }
        .footer { text-align: center; margin-top: 20px; border-top: 2px dashed #000; padding-top: 10px; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SHOPEASE</h2>
        <p>Sistem Manajemen Penjualan</p>
        <p>Terima Kasih Atas Kunjungan Anda</p>
    </div>
    
    <div class="info">
        <p><strong>No. Transaksi:</strong> #{{ $transaksi->id }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
        <p><strong>Kasir:</strong> {{ $transaksi->kasir->name ?? '-' }}</p>
        @if($transaksi->member)
        <p><strong>Member:</strong> {{ $transaksi->member->nama_member }} ({{ $transaksi->member->kode_member }})</p>
        @endif
        @if($transaksi->metode_pembayaran)
        <p><strong>Pembayaran:</strong> {{ $transaksi->metode_pembayaran }}</p>
        @endif
    </div>
    
    <table>
        <tbody>
            @foreach($transaksi->detail as $detail)
            <tr class="item-row">
                <td colspan="3">{{ $detail->barang->nama_barang }}</td>
            </tr>
            <tr class="item-row">
                <td width="50%">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                <td width="50%" class="right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total-section">
        <table>
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td class="right">Rp {{ number_format($transaksi->total_harga + $transaksi->diskon, 0, ',', '.') }}</td>
            </tr>
            @if($transaksi->diskon > 0)
            <tr>
                <td><strong>Diskon:</strong></td>
                <td class="right">- Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="font-size: 14px;">
                <td><strong>TOTAL:</strong></td>
                <td class="right"><strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        <p>*** Barang yang sudah dibeli tidak dapat dikembalikan ***</p>
        <p>Hubungi kami: shopease@example.com</p>
    </div>
</body>
</html>
