<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function import()
    {
        // $res = Excel::toCollection(new PartPriceList, base_path('importData.xlsx'));
        $path = base_path('importData.xlsx');
        $data = Excel::load($path)->get();

        dd($data);
        return redirect('/')->with('success', 'All good!');
    }
}
