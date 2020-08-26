<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Category;
use App\CMS_page;
use App\FrontEmail;
use App\frontUser;
use App\productAttr;
use App\Products;
use Auth;
use Session;
use DB;

class CMSPageController extends Controller
{
    //view the CMS Page
    public function viewCMSPage()
    {
        $CMSShow = CMS_page::get();

        return view('admin.CMS-Pages.View_CMS_Page', compact('CMSShow'));
    }
    // view create Page of CMS
    public function createCMSPage()
    {

        return view('admin.CMS-Pages.create_CMS_Page');
    }

    public function SotreCMSPage(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }

            if (empty($data['Meta_title'])) {
                $data['Meta_title'] = "";
            }
            if (empty($data['Meta_dec'])) {
                $data['Meta_dec'] = "";
            }
            if (empty($data['Meta_Keywords'])) {
                $data['Meta_Keywords'] = "";
            }
            // store the data the comes
            $SaveData = new CMS_page;
            $SaveData->title = $data['title'];
            $SaveData->descrption = $data['CMS_dec'];
            $SaveData->meta_title = $data['Meta_title'];
            $SaveData->meta_description = $data['Meta_dec'];
            $SaveData->meta_Keywords = $data['Meta_Keywords'];
            $SaveData->url = $data['url'];
            $SaveData->status = $status;
            $SaveData->save();
        }
        return redirect()->back()->with('success', 'Your Item Has Been Inserted Successfully!!!');
    }
    public function EditCMSPage($id)
    {
        $CMSShow = CMS_page::where(['id' => $id])->first();

        return view('admin.CMS-Pages.Edit_CMS_Page', compact('CMSShow'));
    }
    public function updateCMSPage(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }

            if (empty($data['Meta_title'])) {
                $data['Meta_title'] = "";
            }
            if (empty($data['Meta_dec'])) {
                $data['Meta_dec'] = "";
            }
            if (empty($data['Meta_Keywords'])) {
                $data['Meta_Keywords'] = "";
            }
            CMS_page::where('id', $id)->update([

                'title' => $data['title'],
                'meta_title' => $data['Meta_title'],
                'descrption' => $data['CMS_dec'],
                'meta_description' => $data['Meta_dec'],
                'meta_Keywords' => $data['Meta_Keywords'],
                'url' => $data['url'],
                'status' => $status

            ]);
            return redirect()->action('CMSPageController@viewCMSPage')->with('success', 'your CMS page has been updated');
        }
    }

    public function DeleteCMSPage($id)
    {
        if (!empty($id)) {
            CMS_page::where('id', $id)->delete();
        }

        return redirect()->action('CMSPageController@viewCMSPage')->with('success', 'your CMS page has been Deleted');
    }


    /******************************************** Front_End CMS page *****************************/

    public function FrontCMSPage($url)
    {
        // check if the page status is disabled
        $checkStatus = CMS_page::where(['status' => 1, 'url' => $url])->count();
        if ($checkStatus == 1) {
            // get the categories for the side bar
            $Showcategory = Category::with('frontCategory')->where(['parent_id' => 0])->get();

            //gegt the CMS page information
            $CMSDetailes = CMS_page::where('url', $url)->first();


            // cart detales in header
            if (Auth::check()) {
                $user_email = Auth::user()->email;
                $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();
            } else {
                $session_id = Session::get('session_id');
                $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
            }

            // create loop to get the product_id then get the image from product table where both have a relation

            foreach ($CartDetalies as $key => $product) {
                // to get image from product table
                $getImageCart = Products::where('id', $product->product_id)->first();
                $CartDetalies[$key]->image = $getImageCart->image;
            }
            // get the meta information
            $meta_title = $CMSDetailes->meta_title;
            $meta_description = $CMSDetailes->meta_description;
            $meta_keywords = $CMSDetailes->meta_keywords;

            return view('front-End.CMSPages.cms_page', compact('CartDetalies', 'CMSDetailes', 'Showcategory', 'meta_title', 'meta_description', 'meta_keywords'));
        } else {
            abort(404);
        }
    }

    // contact page to send email and messages to admins

    public function ContactUsCMSPage()
    {
        // cart detales in header
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();
        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation
        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }
        // get the name of the website * Meta Tags *
        $meta_title = "Home | Contact_us"; // name of the main website
        $meta_description = "Online Website To Sell Modren Clothes For All ages and Genders"; // name of the main website
        $meta_keywords = "online shopping , men clotthing ,clothes ,women clothing , E-commerce ,kids clothing , online store ,store "; // name of the main website

        return view('Front-End.CMSPages.contact_us', compact('CartDetalies', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    /**
     * Undocumented function
     *
     *
     *  For this function is very important for the admin and users where thre users can send the issues
     * and it has many ways to be done
     *
     * 1-) create table in database to handle the messages then show it in admin panel to answer it
     *
     *  2-) send the information though the email itself
     *
     *
     * i will use both ways and i will start with creating the table first
     */

    // hold the data from contact us form to send it to admin
    public function IssueOfContactUs(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['subject'])) {
                $Subject = "UNKNOWN";
            } else {
                $Subject = $data['subject'];
            }
            $UserEmail = new FrontEmail;
            $UserEmail->Name = $data['name'];
            $UserEmail->Email = $data['email'];
            $UserEmail->Subject = $Subject;
            $UserEmail->Message = $data['message'];
            $UserEmail->status = 0;
            $UserEmail->save();
        }
        return redirect()->back()->with('success', 'Your message has been sent Succesfully!!! , Admins will reply as soon as possible');
    }

    // view contact us messages from admins panel

    public function viewContactMessages()
    {
        // get all Emails that user sent to admin
        $UserEmails = FrontEmail::orderBy('created_at', 'DESC')->get();
        return view('admin.users.view_User_Emails', compact('UserEmails'));
    }

    public function AdminReplyMessages(Request $request, $id)
    {
        $showMessage = FrontEmail::orderBy('created_at', 'DESC')->where('id', $id)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
        }
        return view('admin.users.reply_User_Emails', compact('showMessage'));
    }
    public function SendReplyEmail(Request $request, $id)
    {
        $showMessage = FrontEmail::where('id', $id)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $Email = $showMessage->Email;
            $name = $showMessage->Name;
            $messageData = ['name' => $showMessage->Name, 'messageData' => $data['reply']];;
            Mail::send('emails.Admin_reply', $messageData, function ($message) use ($Email) {
                $message->to($Email)->subject('Reply Message');;
            });
            if (empty($showMessage->admin_reply)) {
                $insertdata = FrontEmail::where('id', $id)->update([
                    'admin_reply' => $data['reply'],
                    'status' => 1
                ]);
            }
            return redirect()->action('CMSPageController@viewContactMessages')->with('success', 'your message has been sent successfully');
        }
    }

    // mark the message as read without reply

    public function MarkAsReadMessage($id)
    {
        if (!empty($id)) {
            FrontEmail::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return redirect()->back();
    }
    public function ShowunReadMessages()
    {
        $unreadMessage = FrontEmail::orderBy('created_at', 'DESC')->where('status', 0)->get();
        return view('admin.users.un_read_messages', compact('unreadMessage'));
    }
    public function SendEmailFromAdmin()
    {
        $unreadMessage = FrontEmail::orderBy('created_at', 'DESC')->where('status', 1)->get();
        foreach ($unreadMessage as $data) {
            if (!empty($data->admin_reply)) {
                $readMessage = FrontEmail::where('status', 1)->get();
            }
        }

        return view('admin.users.read_messages', compact('readMessage'));
    }
}
