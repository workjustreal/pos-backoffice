<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductDetailExport implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents, WithStyles, WithColumnFormatting
{
    protected $data;
    protected $title;
    public function __construct($data, $title, $status)
    {
        $this->data = $data;
        $this->status = $status;
        $this->title = 'SKU : ' . $title;
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function map($data): array
    {
        return [
            $data->order_number,
            $this->status,
            $data->name,
            $data->qty,
            $data->price,
            $data->total_price,
            $data->created_at,
        ];
    }
    public function headings(): array
    {
        return [
            [$this->title],
            [
                'เลขออเดอร์',
                'สถานะออเดอร์',
                'ชื่อสินค้า',
                'จำนวน',
                'ราคาสินค้า/ชิ้น',
                'ราคารวม',
                'วันที่/เวลา ในบิล',
            ],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 15,
            'C' => 50,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 25,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:G2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:G2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
                $event->sheet->getDelegate()->getStyle('A1:G1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('008c68');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->getDelegate()->getStyle('A1:G1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:G2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['size' => 16]],
        ];
    }
}