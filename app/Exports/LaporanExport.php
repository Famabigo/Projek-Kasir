<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Pesanan;
use App\Models\Barang;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle, WithEvents
{
    protected $tanggalMulai;
    protected $tanggalAkhir;
    protected $filterPembeli;
    protected $barangId;
    protected $filterMetode; // 'all', 'online', 'offline'
    
    public function __construct($tanggalMulai, $tanggalAkhir, $filterPembeli = 'all', $barangId = null, $filterMetode = 'all')
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalAkhir = $tanggalAkhir;
        $this->filterPembeli = $filterPembeli;
        $this->barangId = $barangId;
        $this->filterMetode = $filterMetode;
    }
    
    public function collection()
    {
        $collection = collect();
        
        // Jika filter offline atau all, ambil dari transaksi
        if ($this->filterMetode === 'offline' || $this->filterMetode === 'all') {
            $queryTransaksi = Transaksi::with('kasir', 'member')
                ->whereBetween('created_at', [
                    Carbon::parse($this->tanggalMulai)->startOfDay(),
                    Carbon::parse($this->tanggalAkhir)->endOfDay()
                ]);
            
            // Filter by pembeli type
            if ($this->filterPembeli === 'member') {
                $queryTransaksi->whereNotNull('member_id');
            } elseif ($this->filterPembeli === 'non-member') {
                $queryTransaksi->whereNull('member_id');
            }
            
            // Filter by barang
            if ($this->barangId) {
                $queryTransaksi->whereHas('detail', function($q) {
                    $q->where('barang_id', $this->barangId);
                });
            }
            
            $transaksi = $queryTransaksi->latest()->get()->map(function($t) {
                return [
                    'type' => 'Offline',
                    'id' => $t->id,
                    'kode' => '-',
                    'tanggal' => $t->created_at,
                    'kasir' => $t->kasir->name ?? '-',
                    'pembeli' => $t->member->nama_member ?? 'Non-Member',
                    'total' => $t->total_harga,
                    'diskon' => $t->diskon,
                    'keuntungan' => $t->keuntungan,
                    'metode_bayar' => $t->metode_pembayaran ?? 'Cash',
                    'status' => 'Selesai'
                ];
            });
            
            $collection = $collection->merge($transaksi);
        }
        
        // Jika filter online atau all, ambil dari pesanan
        if ($this->filterMetode === 'online' || $this->filterMetode === 'all') {
            $queryPesanan = Pesanan::with('user', 'kasir', 'details')
                ->whereBetween('created_at', [
                    Carbon::parse($this->tanggalMulai)->startOfDay(),
                    Carbon::parse($this->tanggalAkhir)->endOfDay()
                ]);
            
            // Filter by pembeli type (semua pesanan online adalah pembeli/user)
            if ($this->filterPembeli === 'non-member') {
                // Skip online orders if filtering for non-members only
                $queryPesanan->whereRaw('1 = 0');
            }
            
            // Filter by barang
            if ($this->barangId) {
                $queryPesanan->whereHas('details', function($q) {
                    $q->where('barang_id', $this->barangId);
                });
            }
            
            $pesanan = $queryPesanan->latest()->get()->map(function($p) {
                // Hitung keuntungan dari details
                $keuntungan = 0;
                foreach ($p->details as $detail) {
                    $keuntungan += ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
                }
                
                return [
                    'type' => 'Online',
                    'id' => $p->id,
                    'kode' => $p->kode_pesanan,
                    'tanggal' => $p->created_at,
                    'kasir' => $p->kasir->name ?? '-',
                    'pembeli' => $p->user->name ?? '-',
                    'total' => $p->total_bayar,
                    'diskon' => $p->diskon,
                    'keuntungan' => $keuntungan,
                    'metode_bayar' => ucfirst($p->metode_pengiriman ?? 'Pickup'),
                    'status' => ucfirst(str_replace('_', ' ', $p->status))
                ];
            });
            
            $collection = $collection->merge($pesanan);
        }
        
        // Sort by tanggal descending
        return $collection->sortByDesc('tanggal')->values();
    }
    
    public function headings(): array
    {
        return [
            'Metode',
            'ID/Kode',
            'Tanggal',
            'Kasir',
            'Pembeli',
            'Total Harga',
            'Diskon',
            'Keuntungan',
            'Pembayaran/Pengiriman',
            'Status'
        ];
    }
    
    public function map($item): array
    {
        return [
            $item['type'],
            $item['kode'] !== '-' ? $item['kode'] : 'T-' . $item['id'],
            Carbon::parse($item['tanggal'])->format('d M Y H:i'),
            $item['kasir'],
            $item['pembeli'],
            'Rp ' . number_format($item['total'], 0, ',', '.'),
            'Rp ' . number_format($item['diskon'], 0, ',', '.'),
            'Rp ' . number_format($item['keuntungan'], 0, ',', '.'),
            $item['metode_bayar'],
            $item['status']
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        // Style untuk header row (row 5 karena ada title dan filter info di atas)
        $headerRow = 5;
        
        return [
            $headerRow => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0C5587'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '0C5587'],
                    ],
                ],
            ],
        ];
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 12,  // Metode
            'B' => 16,  // ID/Kode
            'C' => 18,  // Tanggal
            'D' => 18,  // Kasir
            'E' => 20,  // Pembeli
            'F' => 18,  // Total
            'G' => 15,  // Diskon
            'H' => 18,  // Keuntungan
            'I' => 22,  // Pembayaran
            'J' => 15,  // Status
        ];
    }
    
    public function title(): string
    {
        return 'Laporan Penjualan';
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Insert title and info at the top
                $sheet->insertNewRowBefore(1, 4);
                
                // Title
                $sheet->setCellValue('A1', 'LAPORAN PENJUALAN');
                $sheet->mergeCells('A1:J1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => '0C5587'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(30);
                
                // Sub title - ShopEase
                $sheet->setCellValue('A2', 'ShopEase Kasir System');
                $sheet->mergeCells('A2:J2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => '666666'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                
                // Periode
                $periode = 'Periode: ' . Carbon::parse($this->tanggalMulai)->format('d M Y') . ' - ' . Carbon::parse($this->tanggalAkhir)->format('d M Y');
                $sheet->setCellValue('A3', $periode);
                $sheet->mergeCells('A3:J3');
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'color' => ['rgb' => '333333'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                
                // Filter info
                $filterInfo = 'Filter: ';
                if ($this->filterMetode === 'online') {
                    $filterInfo .= 'Pembelian Online';
                } elseif ($this->filterMetode === 'offline') {
                    $filterInfo .= 'Pembelian Offline';
                } else {
                    $filterInfo .= 'Semua Metode';
                }
                
                if ($this->filterPembeli === 'member') {
                    $filterInfo .= ' | Hanya Member';
                } elseif ($this->filterPembeli === 'non-member') {
                    $filterInfo .= ' | Hanya Non-Member';
                }
                
                if ($this->barangId) {
                    $barang = Barang::find($this->barangId);
                    if ($barang) {
                        $filterInfo .= ' | Produk: ' . $barang->nama_barang;
                    }
                }
                
                $sheet->setCellValue('A4', $filterInfo);
                $sheet->mergeCells('A4:J4');
                $sheet->getStyle('A4')->applyFromArray([
                    'font' => [
                        'size' => 9,
                        'italic' => true,
                        'color' => ['rgb' => '666666'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF8DC'],
                    ],
                ]);
                
                // Get the last row number
                $lastRow = $sheet->getHighestRow();
                
                // Apply borders to all data rows
                $sheet->getStyle('A5:J' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);
                
                // Apply alternating row colors
                for ($row = 6; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F9F9F9'],
                            ],
                        ]);
                    }
                }
                
                // Calculate totals
                $collection = $this->collection();
                $totalPendapatan = $collection->sum('total');
                $totalDiskon = $collection->sum('diskon');
                $totalKeuntungan = $collection->sum('keuntungan');
                $totalTransaksi = $collection->count();
                
                // Add footer with totals
                $footerRow = $lastRow + 2;
                $sheet->setCellValue('A' . $footerRow, 'RINGKASAN');
                $sheet->mergeCells('A' . $footerRow . ':J' . $footerRow);
                $sheet->getStyle('A' . $footerRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => '0C5587'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'EDF7FC'],
                    ],
                ]);
                
                $footerRow++;
                $sheet->setCellValue('A' . $footerRow, 'Total Transaksi:');
                $sheet->setCellValue('B' . $footerRow, $totalTransaksi . ' transaksi');
                $sheet->mergeCells('B' . $footerRow . ':D' . $footerRow);
                
                $footerRow++;
                $sheet->setCellValue('A' . $footerRow, 'Total Pendapatan:');
                $sheet->setCellValue('B' . $footerRow, 'Rp ' . number_format($totalPendapatan, 0, ',', '.'));
                $sheet->mergeCells('B' . $footerRow . ':D' . $footerRow);
                $sheet->getStyle('B' . $footerRow)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('008000'));
                
                $footerRow++;
                $sheet->setCellValue('A' . $footerRow, 'Total Diskon:');
                $sheet->setCellValue('B' . $footerRow, 'Rp ' . number_format($totalDiskon, 0, ',', '.'));
                $sheet->mergeCells('B' . $footerRow . ':D' . $footerRow);
                
                $footerRow++;
                $sheet->setCellValue('A' . $footerRow, 'Total Keuntungan:');
                $sheet->setCellValue('B' . $footerRow, 'Rp ' . number_format($totalKeuntungan, 0, ',', '.'));
                $sheet->mergeCells('B' . $footerRow . ':D' . $footerRow);
                $sheet->getStyle('B' . $footerRow)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('0C5587'));
                
                // Style footer
                $firstFooter = $lastRow + 3;
                $lastFooter = $firstFooter + 4;
                $sheet->getStyle('A' . $firstFooter . ':A' . $lastFooter)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                
                // Timestamp
                $footerRow += 2;
                $sheet->setCellValue('A' . $footerRow, 'Dicetak: ' . now()->format('d M Y H:i:s'));
                $sheet->mergeCells('A' . $footerRow . ':J' . $footerRow);
                $sheet->getStyle('A' . $footerRow)->applyFromArray([
                    'font' => [
                        'size' => 9,
                        'italic' => true,
                        'color' => ['rgb' => '999999'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
