<?php

namespace App\Exports;

use App\Models\Transaksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $tanggalMulai;
    protected $tanggalAkhir;
    
    public function __construct($tanggalMulai, $tanggalAkhir)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalAkhir = $tanggalAkhir;
    }
    
    public function collection()
    {
        return Transaksi::with('kasir', 'member')
            ->whereBetween('created_at', [
                Carbon::parse($this->tanggalMulai)->startOfDay(),
                Carbon::parse($this->tanggalAkhir)->endOfDay()
            ])
            ->latest()
            ->get();
    }
    
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal',
            'Kasir',
            'Member',
            'Total Harga',
            'Diskon',
            'Keuntungan',
            'Metode Pembayaran'
        ];
    }
    
    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->created_at->format('d M Y H:i'),
            $transaksi->kasir->name ?? '-',
            $transaksi->member->nama_member ?? '-',
            'Rp ' . number_format($transaksi->total_harga, 0, ',', '.'),
            'Rp ' . number_format($transaksi->diskon, 0, ',', '.'),
            'Rp ' . number_format($transaksi->keuntungan, 0, ',', '.'),
            $transaksi->metode_pembayaran ?? 'Cash'
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0C5587'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 18,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 18,
            'G' => 20,
            'H' => 18,
        ];
    }
    
    public function title(): string
    {
        return 'Laporan Penjualan';
    }
}
