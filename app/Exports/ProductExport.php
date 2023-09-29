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

class ProductExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents, WithStyles, WithColumnFormatting, WithCustomValueBinder
{
    protected $data;
    protected $title;
    protected $pos;
    protected $total_price;
    protected $list_count;
    protected $product_count;
    public function __construct($data, $title, $pos,$total_price,$list_count,$product_count)
    {
        $this->data = $data;
        $this->total_price = "ราคารวม ". $total_price;
        $this->list_count = "รายการสินค้า " . $list_count;
        $this->product_count = "จำนวนสินค้า ". $product_count;
        if ($title == null) {
            $this->title = "ร้านค้าทั้งหมด";
        } else {
            $this->title = $title;
        }
        if ($pos == null) {
            $this->pos = "เครื่อง POS ทั้งหมด";
        } else {
            $this->pos = $pos;
        }
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function map($data): array
    {
        return [
            $data->sku,
            $data->barcode,
            $data->name,
            $data->qty,
            $data->price,
            $data->total_price,
        ];
    }
    public function headings(): array
    {
        return [
            [$this->title],
            [$this->pos],
            [$this->list_count],
            [$this->product_count],
            [$this->total_price],
            [
                'SKU',
                'Barcode',
                'ชื่อสินค้า',
                'จำนวน',
                'ราคาสินค้า/ชิ้น',
                'ราคารวม',
            ],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 30,
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
        if ($cell->getColumn() == 'B') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,

        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:G2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:G2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:G3')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4:G4')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A5:G5')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:F3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
                $event->sheet->getDelegate()->getStyle('A2:F2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
                     $event->sheet->getDelegate()->getStyle('A3:F3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('6EBCEC');
                     $event->sheet->getDelegate()->getStyle('A4:F4')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('6EBCEC');
                     $event->sheet->getDelegate()->getStyle('A5:F5')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('6EBCEC');
                $event->sheet->getDelegate()->getStyle('A1:F1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('008c68');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:F2');
                $event->sheet->mergeCells('A3:F3');
                $event->sheet->mergeCells('A4:F4');
                $event->sheet->mergeCells('A5:F5');
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
                    $event->sheet->getDelegate()->getStyle('A5:G5')
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
