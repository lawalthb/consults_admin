<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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



	Route::get('', 'IndexController@index')->name('index');
	Route::get('index/login', 'IndexController@login')->name('login');
	
	
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('auth/register', 'AuthController@register')->name('auth.register');
	Route::post('auth/register_store', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'rbac'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Admins_Tb Controller */	
	Route::get('admins_tb', 'Admins_TbController@index')->name('admins_tb.index');
	Route::get('admins_tb/index', 'Admins_TbController@index')->name('admins_tb.index');
	Route::get('admins_tb/index/{filter?}/{filtervalue?}', 'Admins_TbController@index')->name('admins_tb.index');	
	Route::get('admins_tb/view/{rec_id}', 'Admins_TbController@view')->name('admins_tb.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('admins_tb/add', 'Admins_TbController@add')->name('admins_tb.add');
	Route::post('admins_tb/store', 'Admins_TbController@store')->name('admins_tb.store');
		
	Route::any('admins_tb/edit/{rec_id}', 'Admins_TbController@edit')->name('admins_tb.edit');	
	Route::get('admins_tb/delete/{rec_id}', 'Admins_TbController@delete');

/* routes for Departments_Tb Controller */	
	Route::get('departments_tb', 'Departments_TbController@index')->name('departments_tb.index');
	Route::get('departments_tb/index', 'Departments_TbController@index')->name('departments_tb.index');
	Route::get('departments_tb/index/{filter?}/{filtervalue?}', 'Departments_TbController@index')->name('departments_tb.index');	
	Route::get('departments_tb/view/{rec_id}', 'Departments_TbController@view')->name('departments_tb.view');	
	Route::get('departments_tb/add', 'Departments_TbController@add')->name('departments_tb.add');
	Route::post('departments_tb/store', 'Departments_TbController@store')->name('departments_tb.store');
		
	Route::any('departments_tb/edit/{rec_id}', 'Departments_TbController@edit')->name('departments_tb.edit');	
	Route::get('departments_tb/delete/{rec_id}', 'Departments_TbController@delete');

/* routes for Level Controller */	
	Route::get('level', 'LevelController@index')->name('level.index');
	Route::get('level/index', 'LevelController@index')->name('level.index');
	Route::get('level/index/{filter?}/{filtervalue?}', 'LevelController@index')->name('level.index');	
	Route::get('level/view/{rec_id}', 'LevelController@view')->name('level.view');	
	Route::get('level/add', 'LevelController@add')->name('level.add');
	Route::post('level/store', 'LevelController@store')->name('level.store');
		
	Route::any('level/edit/{rec_id}', 'LevelController@edit')->name('level.edit');	
	Route::get('level/delete/{rec_id}', 'LevelController@delete');

/* routes for Model_Has_Permissions Controller */	
	Route::get('model_has_permissions', 'Model_Has_PermissionsController@index')->name('model_has_permissions.index');
	Route::get('model_has_permissions/index', 'Model_Has_PermissionsController@index')->name('model_has_permissions.index');
	Route::get('model_has_permissions/index/{filter?}/{filtervalue?}', 'Model_Has_PermissionsController@index')->name('model_has_permissions.index');	
	Route::get('model_has_permissions/view/{rec_id}', 'Model_Has_PermissionsController@view')->name('model_has_permissions.view');	
	Route::get('model_has_permissions/add', 'Model_Has_PermissionsController@add')->name('model_has_permissions.add');
	Route::post('model_has_permissions/store', 'Model_Has_PermissionsController@store')->name('model_has_permissions.store');
		
	Route::any('model_has_permissions/edit/{rec_id}', 'Model_Has_PermissionsController@edit')->name('model_has_permissions.edit');	
	Route::get('model_has_permissions/delete/{rec_id}', 'Model_Has_PermissionsController@delete');

/* routes for Model_Has_Roles Controller */	
	Route::get('model_has_roles', 'Model_Has_RolesController@index')->name('model_has_roles.index');
	Route::get('model_has_roles/index', 'Model_Has_RolesController@index')->name('model_has_roles.index');
	Route::get('model_has_roles/index/{filter?}/{filtervalue?}', 'Model_Has_RolesController@index')->name('model_has_roles.index');	
	Route::get('model_has_roles/view/{rec_id}', 'Model_Has_RolesController@view')->name('model_has_roles.view');	
	Route::get('model_has_roles/add', 'Model_Has_RolesController@add')->name('model_has_roles.add');
	Route::post('model_has_roles/store', 'Model_Has_RolesController@store')->name('model_has_roles.store');
		
	Route::any('model_has_roles/edit/{rec_id}', 'Model_Has_RolesController@edit')->name('model_has_roles.edit');	
	Route::get('model_has_roles/delete/{rec_id}', 'Model_Has_RolesController@delete');

/* routes for Order_Tb Controller */	
	Route::get('order_tb', 'Order_TbController@index')->name('order_tb.index');
	Route::get('order_tb/index', 'Order_TbController@index')->name('order_tb.index');
	Route::get('order_tb/index/{filter?}/{filtervalue?}', 'Order_TbController@index')->name('order_tb.index');	
	Route::get('order_tb/view/{rec_id}', 'Order_TbController@view')->name('order_tb.view');	
	Route::get('order_tb/add', 'Order_TbController@add')->name('order_tb.add');
	Route::post('order_tb/store', 'Order_TbController@store')->name('order_tb.store');
		
	Route::any('order_tb/edit/{rec_id}', 'Order_TbController@edit')->name('order_tb.edit');	
	Route::get('order_tb/delete/{rec_id}', 'Order_TbController@delete');	
	Route::get('order_tb/checkout/{rec_id}', 'Order_TbController@checkout')->name('order_tb.checkout');

/* routes for Payment_Tb Controller */	
	Route::get('payment_tb', 'Payment_TbController@index')->name('payment_tb.index');
	Route::get('payment_tb/index', 'Payment_TbController@index')->name('payment_tb.index');
	Route::get('payment_tb/index/{filter?}/{filtervalue?}', 'Payment_TbController@index')->name('payment_tb.index');	
	Route::get('payment_tb/view/{rec_id}', 'Payment_TbController@view')->name('payment_tb.view');	
	Route::get('payment_tb/add', 'Payment_TbController@add')->name('payment_tb.add');
	Route::post('payment_tb/store', 'Payment_TbController@store')->name('payment_tb.store');
		
	Route::any('payment_tb/edit/{rec_id}', 'Payment_TbController@edit')->name('payment_tb.edit');	
	Route::get('payment_tb/delete/{rec_id}', 'Payment_TbController@delete');

/* routes for Permissions Controller */	
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index');	
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');	
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/store', 'PermissionsController@store')->name('permissions.store');
		
	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');	
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');

/* routes for Product_Departments Controller */	
	Route::get('product_departments', 'Product_DepartmentsController@index')->name('product_departments.index');
	Route::get('product_departments/index', 'Product_DepartmentsController@index')->name('product_departments.index');
	Route::get('product_departments/index/{filter?}/{filtervalue?}', 'Product_DepartmentsController@index')->name('product_departments.index');	
	Route::get('product_departments/view/{rec_id}', 'Product_DepartmentsController@view')->name('product_departments.view');	
	Route::get('product_departments/add', 'Product_DepartmentsController@add')->name('product_departments.add');
	Route::post('product_departments/store', 'Product_DepartmentsController@store')->name('product_departments.store');
		
	Route::any('product_departments/edit/{rec_id}', 'Product_DepartmentsController@edit')->name('product_departments.edit');	
	Route::get('product_departments/delete/{rec_id}', 'Product_DepartmentsController@delete');

/* routes for Products_Tb Controller */	
	Route::get('products_tb', 'Products_TbController@index')->name('products_tb.index');
	Route::get('products_tb/index', 'Products_TbController@index')->name('products_tb.index');
	Route::get('products_tb/index/{filter?}/{filtervalue?}', 'Products_TbController@index')->name('products_tb.index');	
	Route::get('products_tb/view/{rec_id}', 'Products_TbController@view')->name('products_tb.view');	
	Route::get('products_tb/add', 'Products_TbController@add')->name('products_tb.add');
	Route::post('products_tb/store', 'Products_TbController@store')->name('products_tb.store');
		
	Route::any('products_tb/edit/{rec_id}', 'Products_TbController@edit')->name('products_tb.edit');	
	Route::get('products_tb/delete/{rec_id}', 'Products_TbController@delete');	
	Route::get('products_tb/for_stock', 'Products_TbController@for_stock');
	Route::get('products_tb/for_stock/{filter?}/{filtervalue?}', 'Products_TbController@for_stock');

/* routes for Role_Has_Permissions Controller */	
	Route::get('role_has_permissions', 'Role_Has_PermissionsController@index')->name('role_has_permissions.index');
	Route::get('role_has_permissions/index', 'Role_Has_PermissionsController@index')->name('role_has_permissions.index');
	Route::get('role_has_permissions/index/{filter?}/{filtervalue?}', 'Role_Has_PermissionsController@index')->name('role_has_permissions.index');	
	Route::get('role_has_permissions/view/{rec_id}', 'Role_Has_PermissionsController@view')->name('role_has_permissions.view');	
	Route::get('role_has_permissions/add', 'Role_Has_PermissionsController@add')->name('role_has_permissions.add');
	Route::post('role_has_permissions/store', 'Role_Has_PermissionsController@store')->name('role_has_permissions.store');
		
	Route::any('role_has_permissions/edit/{rec_id}', 'Role_Has_PermissionsController@edit')->name('role_has_permissions.edit');	
	Route::get('role_has_permissions/delete/{rec_id}', 'Role_Has_PermissionsController@delete');

/* routes for Roles Controller */	
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/store', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');	
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');

/* routes for Sales_Tb Controller */	
	Route::get('sales_tb', 'Sales_TbController@index')->name('sales_tb.index');
	Route::get('sales_tb/index', 'Sales_TbController@index')->name('sales_tb.index');
	Route::get('sales_tb/index/{filter?}/{filtervalue?}', 'Sales_TbController@index')->name('sales_tb.index');	
	Route::get('sales_tb/view/{rec_id}', 'Sales_TbController@view')->name('sales_tb.view');	
	Route::get('sales_tb/add', 'Sales_TbController@add')->name('sales_tb.add');
	Route::post('sales_tb/store', 'Sales_TbController@store')->name('sales_tb.store');
		
	Route::any('sales_tb/edit/{rec_id}', 'Sales_TbController@edit')->name('sales_tb.edit');	
	Route::get('sales_tb/delete/{rec_id}', 'Sales_TbController@delete');	
	Route::get('sales_tb/checkout_order', 'Sales_TbController@checkout_order')->name('sales_tb.checkout_order');
	Route::post('sales_tb/checkout_order_store', 'Sales_TbController@checkout_order_store')->name('sales_tb.checkout_order_store');
		
	Route::get('sales_tb/advlist', 'Sales_TbController@advlist');
	Route::get('sales_tb/advlist/{filter?}/{filtervalue?}', 'Sales_TbController@advlist');

/* routes for Stock_Tb Controller */	
	Route::get('stock_tb', 'Stock_TbController@index')->name('stock_tb.index');
	Route::get('stock_tb/index', 'Stock_TbController@index')->name('stock_tb.index');
	Route::get('stock_tb/index/{filter?}/{filtervalue?}', 'Stock_TbController@index')->name('stock_tb.index');	
	Route::get('stock_tb/view/{rec_id}', 'Stock_TbController@view')->name('stock_tb.view');	
	Route::get('stock_tb/add', 'Stock_TbController@add')->name('stock_tb.add');
	Route::post('stock_tb/store', 'Stock_TbController@store')->name('stock_tb.store');
		
	Route::any('stock_tb/edit/{rec_id}', 'Stock_TbController@edit')->name('stock_tb.edit');	
	Route::get('stock_tb/delete/{rec_id}', 'Stock_TbController@delete');	
	Route::get('stock_tb/vendor_stock', 'Stock_TbController@vendor_stock');
	Route::get('stock_tb/vendor_stock/{filter?}/{filtervalue?}', 'Stock_TbController@vendor_stock');	
	Route::get('stock_tb/vendor_qty', 'Stock_TbController@vendor_qty');
	Route::get('stock_tb/vendor_qty/{filter?}/{filtervalue?}', 'Stock_TbController@vendor_qty');

/* routes for User_Orders_View Controller */	
	Route::get('user_orders_view', 'User_Orders_ViewController@index')->name('user_orders_view.index');
	Route::get('user_orders_view/index', 'User_Orders_ViewController@index')->name('user_orders_view.index');
	Route::get('user_orders_view/index/{filter?}/{filtervalue?}', 'User_Orders_ViewController@index')->name('user_orders_view.index');

/* routes for Users_Tb Controller */	
	Route::get('users_tb', 'Users_TbController@index')->name('users_tb.index');
	Route::get('users_tb/index', 'Users_TbController@index')->name('users_tb.index');
	Route::get('users_tb/index/{filter?}/{filtervalue?}', 'Users_TbController@index')->name('users_tb.index');	
	Route::get('users_tb/view/{rec_id}', 'Users_TbController@view')->name('users_tb.view');	
	Route::get('users_tb/add', 'Users_TbController@add')->name('users_tb.add');
	Route::post('users_tb/store', 'Users_TbController@store')->name('users_tb.store');
		
	Route::any('users_tb/edit/{rec_id}', 'Users_TbController@edit')->name('users_tb.edit');	
	Route::get('users_tb/delete/{rec_id}', 'Users_TbController@delete');

/* routes for Vendors_Tb Controller */	
	Route::get('vendors_tb', 'Vendors_TbController@index')->name('vendors_tb.index');
	Route::get('vendors_tb/index', 'Vendors_TbController@index')->name('vendors_tb.index');
	Route::get('vendors_tb/index/{filter?}/{filtervalue?}', 'Vendors_TbController@index')->name('vendors_tb.index');	
	Route::get('vendors_tb/view/{rec_id}', 'Vendors_TbController@view')->name('vendors_tb.view');	
	Route::get('vendors_tb/add', 'Vendors_TbController@add')->name('vendors_tb.add');
	Route::post('vendors_tb/store', 'Vendors_TbController@store')->name('vendors_tb.store');
		
	Route::any('vendors_tb/edit/{rec_id}', 'Vendors_TbController@edit')->name('vendors_tb.edit');	
	Route::get('vendors_tb/delete/{rec_id}', 'Vendors_TbController@delete');
});

	
Route::get('componentsdata/admins_tb_firstname_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->admins_tb_firstname_value_exist($request);
	}
);
	
Route::get('componentsdata/admins_tb_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->admins_tb_email_value_exist($request);
	}
);
	
Route::get('componentsdata/departments_tb_name_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->departments_tb_name_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/permission_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->permission_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/order_tb_order_no_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->order_tb_order_no_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/user_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/vendor_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->vendor_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/product_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->product_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/payment_tb_vendor_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->payment_tb_vendor_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/product_departments_product_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->product_departments_product_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/department_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->department_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/level_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->level_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/vendor_email_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->vendor_email_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/order_no_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->order_no_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sales_tb_product_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sales_tb_product_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sales_tb_user_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sales_tb_user_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/checkout_by_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->checkout_by_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sales_tb_vendor_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sales_tb_vendor_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/user_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/department_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->department_option_list($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');