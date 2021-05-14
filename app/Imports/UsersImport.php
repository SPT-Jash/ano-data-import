<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ImportAny;

class DeviceImport implements WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function sheets(): array
    {
        return [
            'Shop' => new ImportAny(),
            'Issue' => new ImportAny(),
            'Devices' => new ImportAny(),
        ];
    }
}
