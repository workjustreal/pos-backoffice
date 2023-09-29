<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCategory implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Category([
            'category_id' => $row['category_id'],
            'parent_id' => $row['parent_id'],
            'name_th' => $row['name_th'],
            'name_en' => $row['name_en'],
            'name_ch' => $row['name_ch'],
        ]);
    }
}
