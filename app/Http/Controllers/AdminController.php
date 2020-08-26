<?php

namespace App\Http\Controllers;

use App\AdminDetailes;
use App\Category;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Middleware\adminDetailes as MiddlewareAdminDetailes;
use App\order;
use App\Products;
use App\subscribeUsers;
use App\User;
use Auth;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class AdminController extends Controller
{

    //Start the app with creating the login page
    // this function will return the admin page that we will create in admin folder
    public function login(Request $request)
    {

        // now we will check if the request is Post and then check if the user is admin or not
        if ($request->isMethod('post')) {
            $data = $request->input();
            //decrypt
            $password = md5($data['password']); // for the secure of the password

            // use this code to spreate the user login from admin login
            $AdminAccount = AdminDetailes::where(['username' => $data['username'], 'password' => $password, 'status' => 1])->count();
            // here we will check the $data if it is matching with Post data
            if ($AdminAccount  > 0) {
                // security part the user can not enter any page untie he register and login
                Session::put('AdminSession', $data['username']); // this will help to add session to admin
                return redirect('admin/dashboard');
            } else {
                return redirect('/admin')->with('error', 'Invalid username or Password please Try again ');
            }
        }
        return view('admin.admin_login');
    }
    // just in cases the user forget his password

    // End The Login and Register page for admin

    //dashboard function

    public function dashboard()
    {
        // security part to check if the user try to enter the dashboard through URl or login form
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login To Enter to dashboard');
        }

        // end security
        /**
         * Count the items for Chart
         */
        // get the users numbers
        $usersCount = User::count('id');
        // get the Admins numbers
        $AdminDetailes = AdminDetailes::select('id')->count();

        // get the Products numbers
        $Products = Products::count('id');

        // get the Orders numbers
        $order = order::count('id');

        /**
         * Get the detailes to Fetsh the informations
         */
        $AdminDetailes = AdminDetailes::where('position', 'Admin')->count();
        $Markting = AdminDetailes::where('position', 'Markting')->count();
        /**
         * Get the detailes to Fetsh the informations
         */
        $subscribeUsers = subscribeUsers::where('status', 1)->count();

        // orders
        $getTheDate = order::select('created_at')->get();
        $ordersForJuan = order::select('Total')->where('created_at', 'like', '%-06-%')->sum('Total');

        return view('admin.dashboard', compact('usersCount', 'AdminDetailes', 'Products', 'order', 'AdminDetailes', 'Markting', 'subscribeUsers', 'ordersForJuan'));
    }

    //End dashoboard

    //setting function where we will let admin change his password

    public function setting()
    {
        // security part to check if the user try to enter the dashboard through URl or login form
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login First To Enter settings ');
        }
        // end security
        $username = AdminDetailes::where(['username' => Session::get('AdminSession')])->first();


        return view('admin.setting', compact('username'));
    }

    //End setting
    public function update(Request $request)
    {
        // security part to check if the user try to enter the password page through URl or login form
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login First To Enter settings ');
        }

        // check the mwthod of form if post or somthing else
        if ($request->isMethod('patch')) {
            $data = $request->all();
            $AdminCheckPass = AdminDetailes::where(['username' => Session::get('AdminSession'), 'password' => md5($data['current_pass'])])->count();
            if ($AdminCheckPass == 1) {
                $password = md5($data['new_pwd']); // this line use to hash the new password
                // then fetch the data of user to update it
                AdminDetailes::where('username', Session::get('AdminSession'))->update(['password' => $password]);
                return redirect('admin/setting')->with('success', 'Your Password has been updated');
            } else {
                return redirect('admin/setting')->with('error', 'Sorry you can not update your password please try again');
            }
        }
    }
    //update profile

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // get the image and update it
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->clientExtension();
                    $filename = rand(1, 100000) . '-' . $extension;
                    $user_avater = 'images/images_backend/UserAvater/' . $filename;
                    Image::make($image_tmp)->resize(50, 50)->save($user_avater);
                    Session::put('imagePath', $filename);
                }
            } else {
                $filename = $data['currnt_image'];
            }
            AdminDetailes::where('username', Session::get('AdminSession'))->update([
                'username' => $data['username'],
                'avatar' => $filename
            ]);
        }
        return redirect()->back()->with('success', 'Your profile has been add successfully!!!!');
    }

    // start the section to check the current password if its correct or not
    public function changPass(Request $request)
    {
        // security part to check if the user try to enter the password page through URl or login form
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login First To Enter settings ');
        }

        $data = $request->all();
        $current_pass = $data['current_pass'];
        $AdminCheckPass = AdminDetailes::where(['username' => Session::get('AdminSession'), 'password' => md5($data['current_pass'])])->count();

        if ($AdminCheckPass == 1) {
            echo 'true';
            die;
        } else {
            echo 'false';
            die;
        }
    }
    // End the section to check the current password if its correct or not
    // update password

    //End Update password



    // view the admin of the page

    public function viewAdmins()
    {
        $ViewAdmins = AdminDetailes::get();
        return view('admin.pageAdmin.view_admins', compact('ViewAdmins'));
    }

    public function addAdmins()
    {
        return view('admin.pageAdmin.add_admins');
    }

    // store the admins data
    public function StoreAdminData(Request $request)
    {
        if ($request->isMethod("post")) {
            $data = $request->all();
            $AdminAccount = AdminDetailes::where(['username' => $data['user_name']])->count();
            // here we will check the $data if it is matching with Post data
            if ($AdminAccount  > 0) {
                return redirect()->back()->with("error", "The Admin name is already Exists , Try again with another username");
            } else {
                $AddAdmin = new AdminDetailes;
                $AddAdmin->username = $data['user_name'];
                $AddAdmin->password = md5($data['pass']);
                $AddAdmin->position = $data['role'];
                $AddAdmin->status = 1;
                $AddAdmin->save();
            }
        }
        return redirect()->action('AdminController@viewAdmins')->with("success", "The New User has been add");
    }


    // edit the admin
    public function EditAminPosition($id)
    {
        $EditAdmin = AdminDetailes::where('id', $id)->first();
        return view('admin.pageAdmin.editAdmin', compact('EditAdmin'));
    }

    // update the detailes
    public function UpdateAminPosition(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['status'])) {
                $data['status'] = 0;
            } else {
                $data['status'] = 1;
            }
            AdminDetailes::where('id', $id)->update([
                'position' => $data['role'],
                'status' => $data['status'],
            ]);
            return redirect()->action('AdminController@viewAdmins')->with("success", "The User has been updated");
        }
    }


    // view the users in admin panel

    public function viewusers()
    {
        $ViewUsers = User::where('admin', 1)->get();
        return view('admin.users.viewusers', compact('ViewUsers'));
    }

    public function banusers($id)
    {
        User::where('id', $id)->update([
            'admin' => 0
        ]);
        return redirect()->action('AdminController@viewusers')->with('success', 'The user got ban , He will not be able to login again');
    }

    public function ViewBanUsers()
    {
        $ViewUsers = User::where('admin', 0)->get();
        return view('admin.users.ViewBanUsers', compact('ViewUsers'));
    }

    public function UnBanUsers($id)
    {
        User::where('id', $id)->update([
            'admin' => 1
        ]);
        return redirect()->action('AdminController@ViewBanUsers')->with('success', 'The user Is Active Now, He will be able to login again');
    }

    public function DeleteUser($id)
    {
        if (!empty($id)) {
            User::where('id', $id)->delete();
        }
        return redirect()->back()->with('success', 'The user has been deleted ');
    }

    //Export Users
    public function ExportUsers()
    {
        return Excel::download(new ExportUsers, "UsersFile" . rand() . ".xlsx");
    }




    //logout page to destroy every thing and then log out

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('success', 'Welcome back to Login page.... ');
    }

    //End logout page



    /**
     *
     *
     * Start to Dispaly the charts informations
     *
     *
     *
     */


    // userscharts
    public function viewusersChart()
    {
        /**
         *  Now we gonna work to show the date of user register so we will start with creating a function to get
         *  current years and months
         *
         *  to get last months or years we can use the function " Sub_Month " and put into it the number of months
         *
         * next step is to count the country ... in this step we gonna try to add new chart to count the users countries
         * to see from whice country our custmers are  if you don not want to add it then skip this part
         *
         */
        $current_user_month = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $previous_Months =  User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(1))->count();

        $previous_Last_Months =  User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2))->count();


        // count the countries

        $userCountry = User::select('country', DB::raw('count(country) as count'))->groupBy('country')->get();
        $userCountry = json_decode(json_encode($userCountry), true);
        return view('admin.Charts.users_charts')->with(compact('userCountry', 'current_user_month', 'previous_Months', 'previous_Last_Months'));
    }

    public function viewSellsChart()
    {
        $current_order_month = order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $previous_Months =  order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(1))->count();

        $previous_Last_Months =  order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        return view('admin.Charts.sells_charts')->with(compact('current_order_month', 'previous_Months', 'previous_Last_Months'));
    }
}
