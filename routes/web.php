<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

    1-) first section for back end side where we start to build the admin pages
        so the first Routes are for admin page
    2-) will be the front End side where you see the routes of front end pages

    1-) A - the admin part has security part where the admin can not do anything without registeration
    2-) A - the ForntEnd part has security part where the user can not do anything without registeration

*/


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');





//1-) login route
Route::match(['get', 'post'], '/admin', 'AdminController@login');



/******************************* security Admin's Route *************************** */
//----=> this part is related to 'RedirectifAuthenticated.php' and you can add any page just like Routes below

Route::group(['middleware' => ['admin']], function () {
    // this line will help to protect the pages from entering without register so this will force them to login first
    /********************************** Admin's Route  *************************** */

    /********************************** Start Main Functions *************************** */
    //2-) dashboard route
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    //3-) setting route to change the password of the admin
    Route::get('/admin/setting', 'AdminController@setting');
    //5-) change password route
    Route::get('/admin/check-pwd', 'AdminController@changPass');
    Route::patch('/admin/update_pass', 'AdminController@update');
    Route::match(['get', 'post'], '/admin/updateprofile', 'AdminController@updateProfile');
    //5-)logout page route
    Route::get('/logout', 'AdminController@logout');

    /********************************** End Main Functions *************************** */

    /********************************** Start showing Admin user *************************** */
    Route::get("admin/viewAdmins", 'AdminController@viewAdmins'); // view the admins of this page
    Route::get("admin/addAdmins", 'AdminController@addAdmins'); // view the admins of this page
    Route::match(['get', 'post'], 'admin/StoreAdminData', 'AdminController@StoreAdminData');
    Route::match(['get', 'post'], '/admin/editAdmin/{id}', 'AdminController@EditAminPosition');
    Route::match(['get', 'post'], '/admin/updateAmin/{id}', 'AdminController@UpdateAminPosition');


    /********************************** End the admin user *************************** */

    /********************************** Start User Admin page Functions *************************** */
    Route::get('/admin/user/viewusers', 'AdminController@viewusers'); // view the users that are active
    Route::get('/admin/user/banusers/{ban}', 'AdminController@banusers'); // ban the user
    Route::get('/admin/user/ViewBanUsers', 'AdminController@ViewBanUsers'); // ban the user
    Route::get('/admin/user/unbanusers/{unban}', 'AdminController@UnBanUsers'); // Un ban the user
    Route::get('/admin/user/{id}', 'AdminController@DeleteUser'); // Delete the user
    Route::get('user/ExportUsers', 'AdminController@ExportUsers'); // Export users as Excel File
    // view the user messages from contact us form
    Route::get('/admin/contact_us', 'CMSPageController@viewContactMessages');
    // get the data for replaying
    Route::match(['get', 'post'], '/admin/admin_reply/{id}', 'CMSPageController@AdminReplyMessages');
    // send replay to user if the admin wants to
    Route::match(['get', 'post'], '/admin/SendReplyEmail/{id}', 'CMSPageController@SendReplyEmail');
    //remark the message as read when the admin click on it
    Route::match(['get', 'post'], '/admin/MarkAsReadMessage/{id}', 'CMSPageController@MarkAsReadMessage');
    // show un read messages only
    Route::get('/admin/show_unread_Messages', 'CMSPageController@ShowunReadMessages');
    // show read messages
    Route::get('/admin/read_Messages', 'CMSPageController@SendEmailFromAdmin');


    // subscribe users
    Route::any('/admin/subscribe', 'SubscribeUsersController@viewSubscribeUser'); // view subscribe users
    Route::any('user/updateStatusSubscriber/{id}', 'SubscribeUsersController@updateStatusSubscriber'); // delete the subscribtion
    Route::any('user/ExportSubscriberEmail', 'SubscribeUsersController@ExportSubscriberEmail'); // Export emails of subscribe users


    /********************************** Start  User Admin page  Functions *************************** */
    Route::get('/admin/chart/UsersChart', 'AdminController@viewusersChart');
    Route::get('/admin/chart/SellsChart', 'AdminController@viewSellsChart');


    /********************************** Start Category Page Routes *************************** */

    // These Routes uses for most of pages to create ,delete ,edite,update and Show

    Route::get('/admin/category/createCategory', 'CategoryController@create');
    Route::post('/admin/category/create', 'CategoryController@store');
    Route::get('/admin/category/viewCategory', 'CategoryController@show');
    Route::get('/admin/category/{item}/edit', 'CategoryController@edit');
    Route::patch('/admin/category/{item}', 'CategoryController@update');
    Route::match(['get', 'post'], '/admin/category/{id}', 'CategoryController@delete'); // use this line to replace "PUT,PACTCH" methods



    /********************************** End Category Page Routes *************************** */


    /********************************** Start Product Page Routes *************************** */

    // These Routes uses for most of pages to create ,delete ,edite,update and Show

    Route::get('admin/product/createProducts', 'ProductsController@create');
    Route::post('admin/product/create', 'ProductsController@store');
    Route::get('admin/product/viewProducts', 'ProductsController@show');
    Route::get('admin/product/view/featuers', 'ProductsController@showFeatuers');
    Route::get('admin/product/{Product}/edit', 'ProductsController@edit');
    Route::match(['get', 'post'], 'admin/product/{product}', 'ProductsController@update');
    Route::get('admin/product/deletImage/{product}', 'ProductsController@deletImage'); // Just to delete image
    Route::get('admin/deletVideo/{id}', 'ProductsController@deletVideo'); // Just to delete video
    Route::match(['get', 'post'], 'admin/deleteProduct/{id}', 'ProductsController@delete'); // main delete for product

    Route::get('/products/ExportProducts', 'ProductsController@ExportProducts'); //Export Excel file for Products
    /********************************** End Product Page Routes *************************** */

    /********************************** Start Product Attribute Page Routes *************************** */
    Route::match(['get', 'post'], 'admin/addProductAttr/{id}', 'ProductsController@addProductAttr'); // still related to product
    Route::match(['get', 'post'], 'admin/addAltrnImage/{id}', 'ProductsController@addAltrnImage'); // still related to product
    Route::match(['get', 'post'], 'admin/EditProductAttr/{id}', 'ProductsController@EditProductAttr'); // still related to product
    Route::get('admin/productAttr/{id}', 'ProductsController@Attrdelete'); // main delete for product
    Route::get('admin/DeleteAltrnImage/{id}', 'ProductsController@AltrnImagedelete'); // main delete for Alternate Image


    /********************************** End Product Attribute Page Routes *************************** */


    /********************************** Start add coupons Page Routes *************************** */
    Route::get('admin/coupon/viewCoupons', 'CouponController@viewCoupon');
    Route::match(['get', 'post'], 'admin/addcoupon', 'CouponController@Addcoupon');
    Route::match(['get', 'post'], 'admin/coupon/create', 'CouponController@storeCoupon');
    Route::match(['get', 'post'], 'admin/coupon/{id}/edit', 'CouponController@editCoupon');
    Route::match(['get', 'post'], 'admin/coupon/{id}', 'CouponController@update');
    Route::match(['get', 'post'], 'admin/couponDelete/{id}', 'CouponController@couponDelete');

    /********************************** End add coupons Page Routes *************************** */

    /********************************** Start The Order Page Routes *************************** */
    Route::get('admin/order/orderview', 'OrderController@viewOrderPage');
    // button  view moew detailes
    Route::get('admin/order/orderview/{id}', 'OrderController@viewMoreDetailes');
    // update the order status
    Route::post('admin/updateOrderStatus', 'OrderController@updateOrderStatus');
    //prict the order as HTML FORM Invoice
    Route::match(['get', 'post'], 'admin/OrderInvoice/{id}', 'OrderController@OrderInvoice');
    Route::match(['get', 'post'], '/getInvoicPDF/{id}', 'OrderController@getInvoicPDF');

    /********************************** End  The Order Page Routes *************************** */



    /********************************** Start add banner Page Routes *************************** */
    Route::match(['get', 'post'], 'admin/addbanners', 'BannerController@Addbanner');
    Route::match(['get', 'post'], 'admin/banners/create', 'BannerController@store');
    Route::match(['get', 'post'], 'admin/viewbanner', 'BannerController@viewbanner');
    Route::match(['get', 'post'], 'admin/{id}/edit', 'BannerController@editbanner');
    Route::match(['get', 'post'], 'admin/update/{id}', 'BannerController@updatebanner');
    Route::match(['get', 'post'], 'admin/delete/{id}', 'BannerController@deletebanner');
    Route::get('admin/deletImage/{id}', 'BannerController@deletImage'); // Just to delete image


    /********************************** End add banner Page Routes *************************** */

    /********************************** Start CMS Pages Routes *************************** */
    Route::get('/admin/view-cms-page', 'CMSPageController@viewCMSPage'); // view the page
    Route::get('/admin/add-cms-page', 'CMSPageController@createCMSPage'); // view the create page
    Route::post('/admin/store-cms-page', 'CMSPageController@SotreCMSPage'); // store data from create page
    Route::match(['get', 'post'], '/admin/CMSEdit/{id}', 'CMSPageController@EditCMSPage'); // store data from create page
    Route::match(['get', 'post'], '/admin/updateEdit/{id}', 'CMSPageController@updateCMSPage'); // store data from create page
    Route::match(['get', 'post'], '/admin/CMSDelete/{id}', 'CMSPageController@DeleteCMSPage'); // store data from create page

    /********************************** End  CMS Pages Routes *************************** */



    /********************************** Start currency Routes *************************** */
    // create new currency
    Route::get('/admin/add-currency', 'CurrencyController@createCurrency'); // show the create page
    Route::post('admin/currency/create', 'CurrencyController@storeCurreny'); // insert data to database
    Route::get('admin/view-currency', 'CurrencyController@ViewCurrencyTable'); // show  the view page
    Route::match(['get', 'post'], 'admin/Editcurrency/{id}', 'CurrencyController@EditCurrency'); // show Edit page
    Route::match(['get', 'post'], 'admin/updatecurrency/{id}', 'CurrencyController@updatecurrency'); // update data
    Route::match(['get', 'post'], 'admin/Deletecurrency/{id}', 'CurrencyController@Deletecurrency'); // update data

    /********************************** End  currency Routes *************************** */

    /********************************** Start Shiiping cart Routes *************************** */
    Route::get('/admin/view-shippingCharge', 'ShippingChargeController@ViewShippingCharge'); // show  the view page
    Route::get('admin/EditCharges/{id}', 'ShippingChargeController@EditCharges'); // Edit  the view page
    Route::patch('admin/updateCharges/{id}', 'ShippingChargeController@updateCharges'); // Edit  the view page

    /********************************** End Shiiping cart Routes *************************** */
});


/******************************* End security Admin's Route *************************** */

/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

/******************************* Section 2 Fornt End Side *************************** */


/******************************* Start Home Page Fornt End *************************** */

Route::get('/', 'FrontIndexController@index');
Route::get('/product/{url}', 'ProductsController@ShowsingleProduct');
Route::get('/quickview/{id}', 'FrontIndexController@QuickView');
// this route is in Ajaz file where we fetch date form here
Route::get('/get-product-price', 'FrontIndexController@AJAXgetPrice');
// this route is from ajax method to check the pincode of the user if valid or not
Route::post('/checkZipCode', 'FrontIndexController@checkZipCode');
//search button for product
Route::match(['get', 'post'], '/Search-Products', 'FrontIndexController@SearchProducts');

// make the fillter route

Route::match(['get', 'post'], '/product-filtter', 'FrontIndexController@FillterProduct');


// check the subscribe Email and make user subscribe

Route::match(['get', 'post'], "/checkSubscribe", "SubscribeUsersController@SubscribeEmial");

/******************************* End Home Page Fornt End *************************** */

/********************************** Start Add Cart Page Routes *************************** */
// show cart here and detalies above
Route::match(['get', 'post'], '/cart', 'ShoppingCartController@ShowCartDetalies'); // show cart
Route::match(['get', 'post'], '/addTocart', 'ShoppingCartController@insertDataToCart');
Route::match(['get', 'post'], '/deletItem/{id}', 'ShoppingCartController@DeleteItem');
Route::match(['get', 'post'], '/deletItemFromwishlist/{id}', 'ShoppingCartController@DeleteItemFromWishlist');
Route::get('/cart/{id}/{quantity}', 'ShoppingCartController@updateQuantity'); // this route to update the quantity of product increase or decrease
route::post('/cart/apply-coupon', 'ShoppingCartController@applycoupon'); // route to check if the coupon is calid or not

/********************************** End Add Cart Page Routes *************************** */

/********************************** Start The login Register page for users *************************** */
Route::get('/Frontregister', 'FrontUserController@register');
Route::post('/Frontlogin', 'FrontUserController@login');
Route::match(['get', 'post'], '/forgotPassword', 'FrontUserController@Forgetpassword');
Route::match(['get', 'post'], '/storedata', 'FrontUserController@storedata');
Route::match(['get', 'post'], '/checkEmail', 'FrontUserController@checkEmail'); // check if email exists and valid in jquary
Route::get('/Frontlogout', 'FrontUserController@Frontlogout');

/********************************** End The login Register page for users *************************** */


// Confirm the account from MAil verfication

Route::match(['get', 'post'], 'confirm/{code}', 'FrontUserController@confirmEmailAccount');


/******************************* security FrontEnd's Route *************************** */

// use this route to let user login before use any of the routes that will list here
Route::group(['middleware' => ['Frontregister']], function () {

    // any of these pages will not be used until the user register
    Route::match(['get', 'post'], '/account', 'FrontUserController@account'); //show account page
    Route::match(['get', 'post'], '/account/update/{id}', 'FrontUserController@accountupdate'); //update account page
    Route::match(['get', 'post'], '/account/check-pwd', 'FrontUserController@changPass'); //update password in account page
    Route::match(['get', 'post'], '/account/updatePass', 'FrontUserController@update'); //update password in account page

    // Start Routes for  checkout page

    // show the checkout page
    Route::get('/checkout', 'FrontUserController@checkout');
    Route::match(['get', 'post'], '/nextStep', 'FrontUserController@updatebillAndShipForms'); // use to update the billing and shipping tables

    // view the order page
    Route::match(['get', 'post'], '/reviewOrder', 'FrontUserController@showTheOrder');

    // payment order page
    Route::match(['get', 'post'], '/paymentMethod', 'FrontUserController@PaymentMethod');
    // COD thanks page
    Route::match(['get', 'post'], '/CODThanksPage', 'FrontUserController@CODThanksPage');
    // Paypal thanks page
    Route::match(['get', 'post'], '/PaypalThanksPage', 'FrontUserController@PaypalThanksPage');
    // return to thanks paypal page from the paypal page
    Route::match(['get', 'post'], '/Paypal/PaypalThanks', 'FrontUserController@returnPaypalThanks');
    Route::match(['get', 'post'], '/Paypal/Cancel', 'FrontUserController@CancelPaypal');
    // History of user orders
    Route::match(['get', 'post'], '/History ', 'FrontUserController@HistoryOrder');
    // get More detales for product when the user click on More detailes in History Page
    Route::match(['get', 'post'], '/ProductOrderDetailes/{id}', 'FrontUserController@ProductOrderDetailes');

    // wish list add product when user login only
    Route::any("/AddToWishlist/{id}", 'WishlistController@AddToWishlist');
    Route::match(['get', 'post'], "/AddToWishlistFromSiglePage/{id}", 'WishlistController@AddToWishlistFromSiglePage');
    Route::match(['get', 'post'], "/Wishlist", 'WishlistController@ViewWishlistPage');
});




// CMS PAGE Route to get the Url link for each page
Route::match(['get', 'post'], '/page/contactUs', 'CMSPageController@ContactUsCMSPage'); // view contact us page
// hold the data from the contact page form
Route::match(['get', 'post'], '/page/sendcontactissue', 'CMSPageController@IssueOfContactUs');
// make the links in the footer or anywere dynimc and showed from the admin
Route::match(['get', 'post'], '/page/{url}', 'CMSPageController@FrontCMSPage');




/******************************* End security FrontEnd's Route *************************** */
