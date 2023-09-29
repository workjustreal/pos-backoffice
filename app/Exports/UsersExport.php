<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents
{
    protected $data;
    protected $title;
    public function __construct($data, $title)
    {
        $this->data = $data;
        $this->title = $title;
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function map($data): array
    {
        return [
            $data->user_id,
            $data->order_number,
            $data->total_price,
            $data->total_qty,
            $data->total_vat,
            $data->status,
            $data->created_at,
        ];
    }
    public function headings(): array
    {
        return [
            'รหัสร้าน',
            'เลขออเดอร์',
            'ราคารวม',
            'จำนวนสินค้า',
            'ราคารวม vat.',
            'สถานะ',
            'วันที่'
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 10,
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
                $event->sheet->getDelegate()->getStyle('A1:G1')->getFont()->setBold(true);
            },
        ];
    }
}
