<?php

namespace App\Http\Controllers;

use App\Imports\PartPriceList;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    public function import()
    {
        // $res = Excel::toCollection(new PartPriceList, base_path('importData.xlsx'));
        $path = base_path('importData.xlsx');
        $data = Excel::load($path)->get();

        dd($data);
        return redirect('/')->with('success', 'All good!');
    }
}
