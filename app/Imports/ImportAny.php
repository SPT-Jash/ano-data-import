<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


HeadingRowFormatter::default('none');
class ImportAny implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new User([
            // 'name'     => $row['device'],
            // 'email'    => $row['type'],
            // 'password' => $row['category'],
            // 'password' => $row['cost'],
        ]);
    }
}
