<?php

namespace App\Exports;

use App\subscribeUsers;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFiles implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    /**
     *
     * once you run the php artisan code you will get this fill and as you can see it created an class attached
     * with the model and down created function to get all subscribeUsers autumaticlly....a-0
     *
     */
    public function collection()
    {
        $subscribeData = subscribeUsers::select("id", "email", "created_at")->where("status", 1)->orderBy('id', 'DESC')->get();
        return $subscribeData;
    }
}
