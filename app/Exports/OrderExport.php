<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents, WithStyles
{
    protected $data;
    protected $date;
    protected $status;
    protected $title;
    protected $pos_name;
    protected $order_count;
    protected $total_price;
    public function __construct($data, $status, $title, $pos_name, $order_count, $date, $total_price)
    {
        $this->data = $data;
        $this->status = $status;
        $this->data = $data;
        $this->total_price = "ราคารวม " . $total_price;
        $this->order_count = $order_count . " ออเดอร์";
        if ($title == null) {
            $this->title = "ร้านค้าทั้งหมด";
        } else {
            $this->title = $title;
        }
        if ($pos_name == null) {
            $this->pos_name = "POS ทั้งหมด";
        } else {
            $this->pos_name = $pos_name;
        }
        if ($date == null) {
            $this->date = "วันที่ในบิลทั้งหมด";
        } else {
            $this->date = "วันที่ในบิล " . $date;
        }
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function map($data): array
    {
        return [
            $data->order_number,
            $data->shop_name,
            $data->name,
            $data->total_qty,
            $data->total_price,
            $this->status,
            $data->updated_at,
        ];
    }
    public function headings(): array
    {
        return [
            [$this->title],
            [$this->pos_name],
            [$this->date],
            [$this->order_count],
            [$this->total_price],
            [
                'เลขออเดอร์',
                'ร้านค้า',
                'POS',
                'จำนวนสินค้า',
                'ราคารวม',
                'สถานะ',
                'วันที่ในบิล',
            ],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 20,
            'D' => 15,
            'E' => 15,
            'F' => 10,
            'G' => 30,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:G2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:G3')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A5:G5')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A6:G6')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:G2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
                $event->sheet->getDelegate()->getStyle('A3:G3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('E4E0FA');
                $event->sheet->getDelegate()->getStyle('A4:G4')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('F2F3F5');
                $event->sheet->getDelegate()->getStyle('A1:G1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('008c68');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->mergeCells('A2:G2');
                $event->sheet->mergeCells('A3:G3');
                $event->sheet->mergeCells('A4:G4');
                $event->sheet->mergeCells('A5:G5');
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
            'A2' => ['font' => ['size' => 13]],
        ];
    }
}