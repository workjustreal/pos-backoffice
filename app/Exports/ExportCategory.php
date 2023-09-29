<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ExportCategory implements FromCollection, WithHeadings, WithColumnWidths, WithMapping, WithEvents, WithStrictNullComparison
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
            $data->category_id,
            $data->parent_id,
            $data->name_th,
            $data->name_en,
            $data->name_ch,
        ];
    }
    public function headings(): array
    {
        return [
            [
                'category_id',
                'parent_id',
                'name_th',
                'name_en',
                'name_ch'
            ]
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 40,
            'D' => 40,
            'E' => 40,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:E1')->getFont()->setBold(true);
            },
        ];
    }
}
