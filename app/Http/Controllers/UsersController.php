<?php

namespace App\Http\Controllers;

use App\Imports\DeviceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\ImportAny;
use App\Models\User;

class UsersController extends Controller
{
    public function import()
    {
        $res = [];
        $path = base_path('Shop.csv');
        User::truncate();
        $csvData = EXCEL::toArray(new ImportAny, $path);


        foreach ($csvData[0] as $key => $data) {
            $fields_string = '';
            foreach ($data as $key => $value) {
                $fields_string .= $key . '=' . $value . '&';
            }
            rtrim($fields_string, '&');
            // dd($data, $fields_string);
            // dd("wait");

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost:8001/api/importData',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $fields_string,
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            array_push($res, $response);
            // dd($response);
        }


        dd($res);
    }


    public function importDevices()
    {
        $res = [];
        $path = base_path('userData.ods');
        User::truncate();
        $excelData = EXCEL::toArray(new DeviceImport, $path);
        // foreach ($excelData['Devices'] as $key => $data) {
        //     $fields_string = '';
        //     foreach ($data as $key => $value) {
        //         $fields_string .= $key . '=' . $value . '&';
        //     }
        //     rtrim($fields_string, '&');
        // dd($data, $fields_string);
        // dd("wait");

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8001/api/importDevices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($excelData['Devices']),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // array_push($res, $response);
        dd($response, json_decode($response));
        // }


        dd($res);
    }
}

//userEmail
//shopName
//mobileNumber
//CommissionFee
//image
//openTime
//closeTime
//description
//addressLine1
//addressLine2
//latitude
//longitude
//City
//State
//zipCode
