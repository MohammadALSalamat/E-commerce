<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\subscribeUsers;
use App\Exports\ExportFiles;
use Maatwebsite\Excel\Facades\Excel;

class SubscribeUsersController extends Controller
{
    /**
     * Important Note For any Error with the ajax code
     * once you get Error message then add the URL of Ajax and add it in "VerifyCsrfToken" make function  as below
     *
     * protected $except = [
        '/checkZipCode',"/checkSubscribe"
        ];
     *
     *
     */

    // check the subscriber user

    public function SubscribeEmial(Request $request)
    {
        $data = $request->all();
        $checkEmail = subscribeUsers::where("email", $data['subscribe'])->count();
        if ($checkEmail == 1) {
            echo "false";
            die;
        } else {
            $addNewSubscriber = new subscribeUsers;
            $addNewSubscriber->email = $data['subscribe'];
            $addNewSubscriber->status = 1;
            $addNewSubscriber->save();
            echo "true";
        }
    }



    // admin panel

    public function viewSubscribeUser()
    {
        $Subscribe = subscribeUsers::get();
        return view("admin.users.subscribeUsers", compact('Subscribe'));
    }

    // change the status of user to become un registerd / subscribe
    public function updateStatusSubscriber($id)
    {
        $changeStatus = subscribeUsers::where('id', $id)->first();
        if ($changeStatus->status == 1) {
            subscribeUsers::where("id", $id)->update([
                'status'=> 0
            ]);
            return redirect()->back()->with("success", "The subscribtion of User [ ".$changeStatus->email." ] has been DeaActived");
        } else {
            subscribeUsers::where("id", $id)->update([
                'status'=> 1
            ]);
            return redirect()->back()->with("success", "The subscribtion of User [ ".$changeStatus->email." ] has been Activate");
        }
    }

    /**
     *  Export is one of the most important things in laravel and we can do so by following the steps
     * 1-) run php artisan make:export ExportFiles --model=subscribeUsers
     * ==> this means that we have to create export file and attach it with the model that we wat to export
     * ==> on this case we attach it with subscribeUser
     * 2-) check the file ExportFile to  get more inforamtions how we did it
     * 3-) run the code bellow to get the file done
     */
    // Export the Files As Execl type .... its very important
    // this code works for version 2.1.0  if you have higher then the code must change
    public function ExportSubscriberEmail()
    {
        // syntax to make Excel Sheet to download the data
        return Excel::download(new ExportFiles, "subscribe".rand().".xlsx");
    }
}
