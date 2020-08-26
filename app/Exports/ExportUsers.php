<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUsers implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // this function use to get the data of rows without headings
    public function collection()
    {
        return User::select("ID" ,"Name" , "Address" , "City" , "State" ,"Country","postcode","phonenumber","Email" ,'created_at')
                        ->where("status",1)
                        ->orderBy('id', 'DESC')
                        ->get();
    }

    // this function use to get the headings without rows
    public function headings():array{
        // add headers that match the select method above
        return ["ID" ,"Name" , "Address" , "City" , "State" ,"Country","postcode","phonenumber","Email" ,'created_at'];
    }
}
