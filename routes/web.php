<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Invoice;
use App\Contract;
use App\Attachment;
use App\Renewal;
use Illuminate\Support\Facades\Crypt;
Route::get('/checkEmail', function() {
    $name = "Sajjad";
    $email = "sajjad@gmail.com";
   return view('emails.newConByUser', compact(['name','email'])); 
});
Route::get('/under-maintenance', function() {
   dd("Mobile Website Under Maintenance...");
});
Route::get('/pdu', function() {
    return view('emails.policyDetails');
});

Route::get('/ksbin/going/under', function() {
    Artisan::call('down');
    echo "Website Going Down...";
});

Route::get('/pdf/{pdf}', function ($pdf){
    // $img = 'http://client.ksbin.com/storage/contracts/18WXElLGSo0TCIEXAtKrqjIlFkHAWhUH1oA5UCXspV.png';
    // $image = base64_encode($img);
    // dd($image);
    
    
	return view('pdf', compact('pdf'));
});
Route::get('/downloadClaim/{encrypted}', function($encrypted) {
    return view('printClaim', compact('encrypted'));
});
Route::get('/printContract/{id}', 'PDFMaker@printContract');

Route::get('/', function () {
	$invoices = Auth::user()->invoices;
	$invoiceCount = count($invoices);
	$contracts = Auth::user()->contracts;
	$contractCount = count($contracts);
	$attachments = Auth::user()->attachments;
	$user = Auth::user();
	$userDocuments = $user->userInvoices;
	$userRenewals = Renewal::where([['status', '=', 0],['user_id', '=', Auth::user()->id]])->get();
    return view('welcome', compact(['user','invoices','invoiceCount','contracts','contractCount', 'userDocuments', 'attachments', 'userRenewals']));
})->middleware('auth')->name('welcome');



Route::group(['middleware' => ['auth','admin']], function () {
	Route::resource('/admin', 'AdminController');
	Route::get('/viewUsers', 'AdminController@allUsers')->name('viewUsers');
	Route::get('/viewAdmins', 'AdminController@allAdmins')->name('viewAdmins');

	// INVOICE ROUTES
	Route::resource('invoice', 'InvoiceController', ['except' => 'create']);
	Route::resource('/invoice', 'InvoiceController');
	Route::get('/invoice/create/{id}', 'InvoiceController@create');
	Route::get('/user/deleteInvoice/{id}', 'InvoiceController@destroy');
	Route::get('/invoicePaid/{id}', 'InvoiceController@Update');
	Route::get('/userInvoices', 'InvoiceController@userInvoices')->name('invoicesByUsers');
	
	// CONTRACT ROUTES
// 	Route::resource('contract', 'ContractController', ['except' => 'create']);
	
	Route::get('/contract/create/{id}', 'ContractController@create');
	
	Route::post('/contract', 'ContractController@store');
	
	Route::get('/deleteContract/{id}', 'ContractController@destroy');
	Route::get('/contractSigned/{id}', 'ContractController@Update');
	
	// ATTACHMENTS
	Route::resource('attachment', 'AttachmentController', ['except' => 'create']);
	Route::resource('/attachment', 'AttachmentController');
	Route::get('/attachment/create/{id}', 'AttachmentController@create');
	

	// ASSIGN POLICY NUMBER
	Route::post('/assign/{id}', 'AdminController@assign');

	// REMOVE USER
	Route::get('/deleteUser/{id}', 'AdminController@deleteUser');
	
    // REMOVE USER INVOICE
    Route::get('/deleteInvoice/{id}', 'UserInvoiceController@deleteInvoiceByUser');
    
    // REMOVE ATTACHMENT
    Route::get('/deleteAttachment/{id}', 'AttachmentController@destroy');
    
    // REMOVE POLICY
    Route::get('/deletePolicy/{id}', 'PolicyController@destroy');
    
    // CLAIMS
    Route::get('/claim', 'ClaimController@index')->name('claims');
    Route::get('/deleteClaim/{id}', 'ClaimController@destroy')->name('deleteClaim');
    
    // User Profiles For Admin
    Route::get('/userprofile/{id}', 'AdminController@userProfile')->name('userProfilesForAdmin');
    
    
    // Upload Policy Details
    Route::post('/userPolicyDetails/{id}', 'AdminController@userPolicyDetails');
    
    // Update Policy Details
    Route::post('/userPolicyDetailsUpdate/{id}', 'AdminController@userPolicyDetailsUpdate');
    
    // Add Admin
    Route::post('/addAdmin', 'AdminController@addAdmin');
    
    Route::get('/policyDetailsUpate', 'AdminController@policyDetailsUpate')->name('policyDetailsUpate');
    
    Route::get('/deleteDetails/{id}', 'AdminController@deleteDetails');
    
    Route::get('/renewals', 'RenewalController@index')->name('renewals');
    
    Route::get('/deleteRenewal/{id}', 'RenewalController@destroy');
    
    Route::post('/renewalPrice/{uid}/{id}', 'RenewalController@setPrice');
    
    Route::get('/document/create/{uid}', 'AdminController@newDocument');
    
});
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/user/invoice', 'InvoiceController@allUserInvoices')->name('userInvoices');
	Route::get('/user/contract', 'ContractController@allUserContracts')->name('userContracts');
	Route::get('/user/contract/{id}', 'ContractController@signDocument')->name('signContract');
// 	Route::post('/user/contract/signed/{userID}/{contractID}', 'ContractController@signContract')->name('contractSigned');
// 	Route::post('/c/u/s/{userID}/{contractID}', 'ContractController@signContract1')->name('contractSigned1');
	Route::resource('/user', 'UserController');
	Route::resource('/userInvoice', 'UserInvoiceController');
	Route::post('/user/contract/signed/{id}', 'PDFMaker@signNow');
	
	Route::post('/uInv', 'UserInvoiceController@docByAdmin');
	
	Route::get('/uInv/{id}', 'UserInvoiceController@deleteInvoiceByUser');
	
	Route::post('/claim', 'ClaimController@store')->name('claim');
	Route::post('/user/claim/signed/{userID}/{id}', 'ClaimController@signClaim')->name('updateClaim');
	
	Route::get('/user/printContract', function() {
	    dd('asd');
	});
	// Add User Profile Photo
    Route::post('/userProfileImage/{id}', 'AdminController@userProfileImage');
    Route::post('/user/details/{id}', 'UserController@policyDetails');
    
    // Get User Payment For Invoice
    Route::get('/payment/{user_id}/{inv_id}', 'PaymentController@approve');
    
    // Get User Payment For Renewal
    Route::get('/payment/renewal/{user_id}/{r_id}', 'PaymentController@approveRenewal');
    
    // Get Renewal
    Route::post('/renewal/{uid}', 'RenewalController@store');
    
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/template', 'AdminController@sendMail');
Route::get('/alertAdmin', function() {
    return view('adminAlert');
});

Route::post('/c/u/s/{userID}/{contractID}', 'ContractController@signContract1')->name('contractSigned1');

Route::post('/newRoute/signature/{id}', function() {
   dd("New Route"); 
});