<?php

use App\Http\Controllers\InstallHelperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ThemeSettingsContoller;
// My controllers
use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WholesellerController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

// installer routes
Route::group(['prefix' => 'install',  'middleware' => ['web', 'install', 'isVerified']], function () {
Route::get('/', [InstallHelperController::class, 'getPurchaseCodeVerifyPage'])->name('verify');
Route::post('verify', [InstallHelperController::class, 'verifyPurchaseCode'])->name('verifyPurchaseCode');
});

// redirect to login page
Route::get('/', function () {
return redirect()->route('login');
});

// admin auth routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['prefix' => 'admin',  'middleware' => ['auth']], function () {
// // admin dashbaord route
// Route::get('dashboard', 'AdminController@index')->name('dashboard');

// // admin profile route
// Route::get('profile', 'AdminController@profilePage')->name('admin.profile');

// // admin profile update route
// Route::put('profile/{email}', 'AdminController@profileUpdate')->name('admin.profile.update');

// // setup route
// Route::get('setup', 'AdminController@setupPage')->name('admin.setup');

// // general settings routes
// Route::get('general-settings', 'AdminController@generalSettings')->name('admin.setup.general');
// Route::post('general-settings', 'AdminController@updateGeneralSettings')->name('admin.setup.general.update');

// // units routes
// Route::resource('units', 'UnitController', [
// 'names' => [
// 'index' => 'units.index',
// 'create' => 'units.create',
// 'store' => 'units.store',
// 'edit' => 'units.edit',
// 'update' => 'units.update'
// ]
// ]);
// Route::get('units/{slug}/staus', 'UnitController@changeStatus')->name('units.status');
// Route::get('units/{slug}/delete', 'UnitController@destroy')->name('units.delete');

// // payment methods routes
// Route::resource('payment-methods', 'PaymentMethodController', [
// 'names' => [
// 'index' => 'payments.index',
// 'create' => 'payments.create',
// 'store' => 'payments.store',
// 'edit' => 'payments.edit',
// 'update' => 'payments.update'
// ]
// ]);
// Route::get('payment-methods/{slug}/staus', 'PaymentMethodController@changeStatus')->name('payments.status');
// Route::get('payment-methods/{slug}/delete', 'PaymentMethodController@destroy')->name('payments.delete');

// // sizes routes
// Route::resource('sizes', 'SizeController', [
// 'names' => [
// 'index' => 'sizes.index',
// 'create' => 'sizes.create',
// 'store' => 'sizes.store',
// 'edit' => 'sizes.edit',
// 'update' => 'sizes.update'
// ]
// ]);
// Route::post('sizes/create', 'SizeController@store')->name('sizes.store');
// Route::get('sizes/{slug}/staus', 'SizeController@changeStatus')->name('sizes.status');
// Route::get('sizes/{slug}/delete', 'SizeController@destroy')->name('sizes.delete');

// // processing steps routes
// Route::resource('processing-steps', 'ProcessingStepController', [
// 'names' => [
// 'index' => 'processing-steps.index',
// 'create' => 'processing-steps.create',
// 'store' => 'processing-steps.store',
// 'edit' => 'processing-steps.edit',
// 'update' => 'processing-steps.update'
// ]
// ]);
// Route::get('processing-steps/{slug}/staus', 'ProcessingStepController@changeStatus')->name('processing-steps.status');
// Route::get('processing-steps/{slug}/delete', 'ProcessingStepController@destroy')->name('processing-steps.delete');

// // showrooms routes
// Route::resource('showrooms', 'ShowroomController', [
// 'names' => [
// 'index' => 'showrooms.index',
// 'create' => 'showrooms.create',
// 'store' => 'showrooms.store',
// 'show' => 'showrooms.show',
// 'edit' => 'showrooms.edit',
// 'update' => 'showrooms.update'
// ]
// ]);
// Route::get('showrooms/{slug}/staus', 'ShowroomController@changeStatus')->name('showrooms.status');
// Route::get('showrooms/{slug}/delete', 'ShowroomController@destroy')->name('showrooms.delete');

// // users routes
// Route::get('/users/pdf', 'UserController@createPDF')->name('users.pdf');
// Route::resource('users', 'UserController', [
// 'names' => [
// 'index' => 'users.index',
// 'create' => 'users.create',
// 'store' => 'users.store',
// 'show' => 'users.show',
// 'edit' => 'users.edit',
// 'update' => 'users.update',
// ]
// ]);
// Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
// Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');


// // expenses categories routes
// Route::get('/expense-categories/pdf', 'ExpenseCategoryController@createPDF')->name('expCategories.pdf');
// Route::resource('expense-categories', 'ExpenseCategoryController', [
// 'names' => [
// 'index' => 'expCategories.index',
// 'create' => 'expCategories.create',
// 'store' => 'expCategories.store',
// 'show' => 'expCategories.show',
// 'edit' => 'expCategories.edit',
// 'update' => 'expCategories.update',
// ]
// ]);
// Route::get('expense-categories/{slug}/staus', 'ExpenseCategoryController@changeStatus')->name('expCategories.status');
// Route::get('expense-categories/{slug}/delete', 'ExpenseCategoryController@destroy')->name('expCategories.delete');

// // expenses routes
// Route::get('/expenses/pdf', 'ExpenseController@createPDF')->name('expenses.pdf');
// Route::resource('expenses', 'ExpenseController', [
// 'names' => [
// 'index' => 'expenses.index',
// 'create' => 'expenses.create',
// 'store' => 'expenses.store',
// 'show' => 'expenses.show',
// 'edit' => 'expenses.edit',
// 'update' => 'expenses.update',
// ]
// ]);
// Route::get('expenses/{slug}/staus', 'ExpenseController@changeStatus')->name('expenses.status');
// Route::get('expenses/{slug}/delete', 'ExpenseController@destroy')->name('expenses.delete');


// // staff routes
// Route::get('/staff/pdf', 'StaffController@createPDF')->name('staff.pdf');
// Route::resource('staff', 'StaffController', [
// 'names' => [
// 'index' => 'staff.index',
// 'create' => 'staff.create',
// 'store' => 'staff.store',
// 'show' => 'staff.show',
// 'edit' => 'staff.edit',
// 'update' => 'staff.update',
// ]
// ]);
// Route::get('staff/{slug}/staus', 'StaffController@changeStatus')->name('staff.status');
// Route::get('staff/{id}/delete', 'StaffController@destroy')->name('staff.delete');

// // supplier routes
// Route::get('/suppliers/pdf', 'SupplierController@createPDF')->name('suppliers.pdf');
// Route::resource('suppliers', 'SupplierController', [
// 'names' => [
// 'index' => 'suppliers.index',
// 'create' => 'suppliers.create',
// 'store' => 'suppliers.store',
// 'show' => 'suppliers.show',
// 'edit' => 'suppliers.edit',
// 'update' => 'suppliers.update',
// ]
// ]);
// Route::get('suppliers/{id}/status', 'SupplierController@changeStatus')->name('suppliers.status');
// Route::get('suppliers/{id}/delete', 'SupplierController@destroy')->name('suppliers.delete');

// // categories route
// Route::get('/categories/pdf', 'CategoryController@createPDF')->name('categories.pdf');
// Route::resource('categories', 'CategoryController', [
// 'names' => [
// 'index' => 'categories.index',
// 'create' => 'categories.create',
// 'store' => 'categories.store',
// 'edit' => 'categories.edit',
// 'update' => 'categories.update',
// ]
// ]);
// Route::get('categories/{id}/status', 'CategoryController@changeStatus')->name('categories.status');
// Route::get('categories/{id}/delete', 'CategoryController@destroy')->name('categories.delete');

// // sub categories route
// Route::get('/sub-categories/pdf', 'SubCategoryController@createPDF')->name('subCategories.pdf');
// Route::resource('sub-categories', 'SubCategoryController', [
// 'names' => [
// 'index' => 'subCategories.index',
// 'create' => 'subCategories.create',
// 'store' => 'subCategories.store',
// 'edit' => 'subCategories.edit',
// 'update' => 'subCategories.update',
// ]
// ]);
// Route::get('sub-categories/{id}/status', 'SubCategoryController@changeStatus')->name('subCategories.status');
// Route::get('sub-categories/{id}/delete', 'SubCategoryController@destroy')->name('subCategories.delete');

// // purchases route
// Route::get('/purchases/pdf', 'PurchaseController@createPDF')->name('purchases.pdf');
// Route::resource('purchases', 'PurchaseController', [
// 'names' => [
// 'index' => 'purchases.index',
// 'create' => 'purchases.create',
// 'store' => 'purchases.store',
// 'show' => 'purchases.show',
// 'edit' => 'purchases.edit',
// 'update' => 'purchases.update',
// ]
// ]);
// Route::get('purchases/{code}/invoice', 'PurchaseController@getInvoice')->name('purchases.invoice');
// Route::get('purchases/{code}/status', 'PurchaseController@changeStatus')->name('purchases.status');
// Route::post('/purchase-products', 'PurchaseController@purchaseProducts')->name('purchase.purchaseProducts');
// Route::get('purchases/{code}/delete', 'PurchaseController@destroy')->name('purchases.delete');


// // return purchases route
// Route::get('/return-purchases/pdf', 'PurchaseReturnController@createPDF')->name('purchaseReturn.pdf');
// Route::resource('return-purchases', 'PurchaseReturnController', [
// 'names' => [
// 'index' => 'purchaseReturn.index',
// 'create' => 'purchaseReturn.create',
// 'store' => 'purchaseReturn.store',
// 'show' => 'purchaseReturn.show',
// 'edit' => 'purchaseReturn.edit',
// 'update' => 'purchaseReturn.update',
// ]
// ]);
// Route::get('return-purchases/{code}/status', 'PurchaseReturnController@changeStatus')->name('purchaseReturn.status');
// Route::get('return-purchases/{code}/delete', 'PurchaseReturnController@destroy')->name('purchaseReturn.delete');


// // damage purchases route
// Route::get('/damage-purchases/pdf', 'PurchaseDamageController@createPDF')->name('purchaseDamage.pdf');
// Route::resource('damage-purchases', 'PurchaseDamageController', [
// 'names' => [
// 'index' => 'purchaseDamage.index',
// 'create' => 'purchaseDamage.create',
// 'store' => 'purchaseDamage.store',
// 'show' => 'purchaseDamage.show',
// 'edit' => 'purchaseDamage.edit',
// 'update' => 'purchaseDamage.update',
// ]
// ]);
// Route::get('damage-purchases/{code}/status', 'PurchaseDamageController@changeStatus')->name('purchaseDamage.status');
// Route::get('damage-purchases/{code}/delete', 'PurchaseDamageController@destroy')->name('purchaseDamage.delete');

// // purchase inventory route
// Route::get('/purchase-inventory/pdf', 'PurchaseInventoryController@createPDF')->name('purchaseInventory.pdf');
// Route::resource('purchase-inventory', 'PurchaseInventoryController', [
// 'names' => [
// 'index' => 'purchaseInventory.index',
// ]
// ]);

// // processing products route
// Route::get('/processing-products/pdf', 'ProcessingProductController@createPDF')->name('processing.pdf');
// Route::resource('processing-products', 'ProcessingProductController', [
// 'names' => [
// 'index' => 'processing.index',
// 'create' => 'processing.create',
// 'store' => 'processing.store',
// 'show' => 'processing.show',
// 'edit' => 'processing.edit',
// 'update' => 'processing.update',
// ]
// ]);
// Route::get('processing-products/{slug}/status', 'ProcessingProductController@changeStatus')->name('processing.status');
// Route::get('processing-products/{slug}/delete', 'ProcessingProductController@destroy')->name('processing.delete');

// // finished products route
// Route::get('/finished-products/pdf', 'FinishedProductController@createPDF')->name('finished.pdf');
// Route::post('/sizes', 'FinishedProductController@productSizes')->name('finished.sizes');
// Route::post('/finished-purchase-products', 'FinishedProductController@finishedPurchaseProducts')->name('finished.purchase.products');
// Route::resource('finished-products', 'FinishedProductController', [
// 'names' => [
// 'index' => 'finished.index',
// 'create' => 'finished.create',
// 'store' => 'finished.store',
// 'show' => 'finished.show',
// 'edit' => 'finished.edit',
// 'update' => 'finished.update',
// ]
// ]);
// Route::get('finished-products/{id}/status', 'FinishedProductController@changeStatus')->name('finished.status');
// Route::get('finished-products/{id}/delete', 'FinishedProductController@destroy')->name('finished.delete');

// // transferred products route
// Route::get('/transferred-products/pdf', 'TransferredProductController@createPDF')->name('transferred.pdf');
// Route::post('/finished-product-sizes', 'TransferredProductController@finishedProductSizes')->name('transferred.finished.sizes');
// Route::resource('transferred-products', 'TransferredProductController', [
// 'names' => [
// 'index' => 'transferred.index',
// 'create' => 'transferred.create',
// 'store' => 'transferred.store',
// 'show' => 'transferred.show',
// 'edit' => 'transferred.edit',
// 'update' => 'transferred.update',
// ]
// ]);
// Route::get('transferred-products/{id}/status', 'TransferredProductController@changeStatus')->name('transferred.status');
// Route::get('transferred-products/{id}/delete', 'TransferredProductController@destroy')->name('transferred.delete');

// // purchase report
// Route::get('purchase-report', 'PurchaseReport@purchaseReport')->name('purchase.report');
// Route::post('purchase-report', 'PurchaseReport@postPurchaseReport')->name('purchase.report.post');

// // processing report
// Route::get('processing-report', 'ProductReport@processingReport')->name('processing.report');
// Route::post('processing-report', 'ProductReport@filterProcessingReport')->name('processing.report.filter');

// // finished report
// Route::get('finished-report', 'ProductReport@finishedReport')->name('finished.report');
// Route::post('finished-report', 'ProductReport@filterFinishedReport')->name('finished.report.filter');

// // transferred report
// Route::get('transferred-report', 'ProductReport@transferredReport')->name('transferred.report');
// Route::post('transferred-report', 'ProductReport@filterTransferredReport')->name('transferred.report.filter');

// // lang change
// Route::get('lang/change', [LanguageController::class, 'change'])->name('changeLang');
// });

Route::post('theme-settings', [ThemeSettingsContoller::class, 'settings'])->name('theme-settings');


// Check user for login
Route::post('/check',[CheckUserController::class,'index'])->name('check.user');


// Before superadmin login
Route::group(['prefix' => 'superadmin'], function() {
Route::group(['middleware' => 'superadmin.guest'], function(){
Route::view('/login','superadmin.auth.login')->name('superadmin.login');
Route::post('/login',[SuperAdminController::class, 'authenticate'])->name('superadmin.auth');
});
// After superadmin login
Route::group(['middleware' => 'superadmin.auth'], function(){
Route::get('/dashboard',[SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
Route::get('lang/change', [LanguageController::class, 'change'])->name('changeLang');
Route::get('profile', [SuperAdminController::class,'profilePage'])->name('superadmin.profile');
Route::put('profile/{email}',[SuperAdminController::class,'profileUpdate'])->name('superadmin.profile.update');

// users routes
Route::get('users/pdf', [UserController::class,'createPDF'])->name('users.pdf');
Route::resource('users', 'UserController', [
'names' => [
'index' => 'users.index',
'create' => 'users.create',
'store' => 'users.store',
'show' => 'users.show',
'edit' => 'users.edit',
'update' => 'users.update',
]
]);
Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');

Route::post('/logout',[SuperAdminController::class,'logout'])->name('superadmin.logout');
});
});

// Before admin login
Route::group(['prefix' => 'admin'], function() {
Route::group(['middleware' => 'admin.guest'], function(){
Route::view('/login','admin.auth.login')->name('admin.login');
Route::post('/login',[AdminController::class, 'authenticate'])->name('admin.auth');
});
// After admin login
Route::group(['middleware' => 'admin.auth'], function(){
Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
Route::get('profile', [AdminController::class,'profilePage'])->name('admin.profile');
Route::put('profile/{email}',[AdminController::class,'profileUpdate'])->name('admin.profile.update');
// users routes
Route::get('users/pdf', [UserController::class,'createPDF'])->name('users.pdf');
Route::resource('users', 'UserController', [
'names' => [
'index' => 'users.index',
'create' => 'users.create',
'store' => 'users.store',
'show' => 'users.show',
'edit' => 'users.edit',
'update' => 'users.update',
]
]);
Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');
});
});

// Before wholeseller login 
Route::group(['prefix' => 'wholeseller'], function() {
Route::group(['middleware' => 'wholeseller.guest'], function(){
Route::view('/login','wholeseller.auth.login')->name('wholeseller.login');
Route::post('/login',[wholesellerController::class, 'authenticate'])->name('wholeseller.auth');
});

// After wholeseller login
Route::group(['middleware' => 'wholeseller.auth'], function(){
Route::get('/dashboard',[WholesellerController::class, 'dashboard'])->name('wholeseller.dashboard');
Route::get('/logout',[WholesellerController::class,'logout'])->name('wholeseller.logout');
Route::get('profile', [WholesellerController::class,'profilePage'])->name('wholeseller.profile');
Route::put('profile/{email}',[WholesellerController::class,'profileUpdate'])->name('wholeseller.profile.update');
// users routes
Route::get('users/pdf', [UserController::class,'createPDF'])->name('users.pdf');
Route::resource('users', 'UserController', [
'names' => [
'index' => 'users.index',
'create' => 'users.create',
'store' => 'users.store',
'show' => 'users.show',
'edit' => 'users.edit',
'update' => 'users.update',
]
]);
Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');
});
});

// Before retailer login
Route::group(['prefix' => 'retailer'], function() {
Route::group(['middleware' => 'retailer.guest'], function(){
Route::view('/login','retailer.auth.login')->name('retailer.login');
Route::post('/login',[RetailerController::class, 'authenticate'])->name('retailer.auth');
});
// After retailer login
Route::group(['middleware' => 'retailer.auth'], function(){
Route::get('/dashboard',[RetailerController::class, 'dashboard'])->name('retailer.dashboard');
Route::get('/logout',[RetailerController::class,'logout'])->name('retailer.logout');
Route::get('profile', [RetailerController::class,'profilePage'])->name('retailer.profile');
Route::put('profile/{email}',[RetailerController::class,'profileUpdate'])->name('retailer.profile.update');
// users routes
Route::get('users/pdf', [UserController::class,'createPDF'])->name('users.pdf');
Route::resource('users', 'UserController', [
'names' => [
'index' => 'users.index',
'create' => 'users.create',
'store' => 'users.store',
'show' => 'users.show',
'edit' => 'users.edit',
'update' => 'users.update',
]
]);
Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');
});
});

// Before shopkeeper login
Route::group(['prefix' => 'shopkeeper'], function() {
Route::group(['middleware' => 'shopkeeper.guest'], function(){
Route::view('/login','shopkeeper.auth.login')->name('shopkeeper.login');
Route::post('/login',[ShopkeeperController::class, 'authenticate'])->name('shopkeeper.auth');
});

// After shopkeeper login
Route::group(['middleware' => 'shopkeeper.auth'], function(){
Route::get('/dashboard',[ShopkeeperController::class, 'dashboard'])->name('shopkeeper.dashboard');
Route::get('/logout',[ShopkeeperController::class,'logout'])->name('shopkeeper.logout');
Route::get('profile', [ShopkeeperController::class,'profilePage'])->name('shopkeeper.profile');
Route::put('profile/{email}',[ShopkeeperController::class,'profileUpdate'])->name('shopkeeper.profile.update');
// users routes
Route::get('users/pdf', [UserController::class,'createPDF'])->name('users.pdf');
Route::resource('users', 'UserController', [
'names' => [
'index' => 'users.index',
'create' => 'users.create',
'store' => 'users.store',
'show' => 'users.show',
'edit' => 'users.edit',
'update' => 'users.update',
]
]);
Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');
});
});

// Before customer login
Route::group(['prefix' => 'customer'], function() {
Route::group(['middleware' => 'customer.guest'], function(){
Route::view('/login','customer.auth.login')->name('customer.login');
Route::post('/login',[CustomerController::class, 'authenticate'])->name('customer.auth');
});

// After customer login
Route::group(['middleware' => 'customer.auth'], function(){
Route::get('/dashboard',[CustomerController::class, 'dashboard'])->name('customer.dashboard');
Route::get('/logout',[CustomerController::class,'logout'])->name('customer.logout');
Route::get('profile', [CustomerController::class,'profilePage'])->name('customer.profile');
Route::put('profile/{email}',[CustomerController::class,'profileUpdate'])->name('customer.profile.update');
// users routes
Route::get('users/pdf', [UserController::class,'createPDF'])->name('users.pdf');
Route::resource('users', 'UserController', [
'names' => [
'index' => 'users.index',
'create' => 'users.create',
'store' => 'users.store',
'show' => 'users.show',
'edit' => 'users.edit',
'update' => 'users.update',
]
]);
Route::get('users/{slug}/staus', 'UserController@changeStatus')->name('users.status');
Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');
});
});


