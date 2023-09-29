<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderDetailExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents, WithColumnFormatting, WithStyles, WithCustomValueBinder
{
    protected $data;
    protected $payment;
    protected $order_number;
    public function __construct($data, $payment, $order_number)
    {
        $this->data = $data;
        $this->payment = $payment;
        $this->order_number = 'เลขออเดอร์ : ' . $order_number;
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function map($data): array
    {
        return [
            $data['sku'],
            $data['barcode'],
            $data['names'],
            $data['price'],
            $data['qty'],
            $data['total_price'],
        ];
    }
    public function headings(): array
    {
        return [
            [$this->order_number],
            ['ID Bank : ' . $this->payment[0]['bank_id']],
            ['From Account : ' . $this->payment[0]['from_account']],
            ['Date Time : ' . $this->payment[0]['datetime']],
            [
                'SKU',
                'Barcode',
                'ชื่อสินค้า',
                'ราคา',
                'จำนวนสินค้า',
                'ราคารวม',
            ],
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 50,
            'C' => 50,
            'D' => 15,
            'E' => 15,
            'F' => 15,
        ];
    }
    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'A') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:F2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:F3')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4:F4')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A5:F5')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A5:F5')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
                $event->sheet->getDelegate()->getStyle('A1:F1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('008c68');
                $event->sheet->getDelegate()->getStyle('A2:F2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('2B99D8');
                $event->sheet->getDelegate()->getStyle('A3:F3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('2B99D8');
                $event->sheet->getDelegate()->getStyle('A4:F4')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('2B99D8');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:F2');
                $event->sheet->mergeCells('A3:F3');
                $event->sheet->mergeCells('A4:F4');
                $event->sheet->getDelegate()->getStyle('A1:G1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:G2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:G3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:G4')
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
