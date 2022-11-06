<?php
use App\Http\Controllers\InstallHelperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ThemeSettingsContoller;
// My controllers
use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use aPP\Http\Controllers\PurchaseController;
use App\Http\Controllers\WholesellerController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdmin\AdminController as SuperAdmin_AdminController;
use App\Http\Controllers\SuperAdmin\WholesallerController as SuperAdmin_WholesellerController;
use App\Http\Controllers\SuperAdmin\RetailerController as SuperAdmin_RetailerController;
use App\Http\Controllers\SuperAdmin\ShopkeeperController as SuperAdmin_ShopkeeperController;
use App\Http\Controllers\SuperAdmin\CustomerController as SuperAdmin_CustomerController;
use App\Http\Controllers\SuperAdmin\ShopController as SuperAdmin_ShopController;
use App\Http\Controllers\SuperAdmin\CategoryController as SuperAdmin_CategoryController;
use App\Http\Controllers\SuperAdmin\ProductController as SuperAdmin_ProductController;
//My added Controllers
use App\Http\Controllers\Wholeseller\CategoryController as Wholeseller_CategoryController;
use App\Http\Controllers\Wholeseller\CustomerController as Wholeseller_CustomerController;
use App\Http\Controllers\Wholeseller\ProductController as Wholeseller_ProductController;
use App\Http\Controllers\Wholeseller\RetailerController as Wholeseller_RetailerController;
use App\Http\Controllers\Wholeseller\ShopController as Wholeseller_ShopController;
use App\Http\Controllers\Wholeseller\ShopkeeperController as Wholeseller_ShopKeeperController;


// installer routes
Route::group(['prefix' => 'install', 'middleware' => ['web', 'install', 'isVerified']], function () {
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

Route::post('theme-settings', [ThemeSettingsContoller::class, 'settings'])->name('theme-settings');

// Check user for login
Route::post('/check', [CheckUserController::class, 'index'])->name('check.user');

// Before superadmin login
Route::group(['prefix' => 'shop'], function () {
    Route::group(['middleware' => 'superadmin.guest'], function () {
        Route::view('/login', 'superadmin.auth.login')->name('superadmin.login');
        Route::post('/login', [SuperAdminController::class, 'authenticate'])->name('superadmin.auth');
    });
// After superadmin login
    Route::group(['middleware' => 'superadmin.auth'], function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
        Route::get('lang/change', [LanguageController::class, 'change'])->name('changeLang');
        Route::get('profile', [SuperAdminController::class, 'profilePage'])->name('superadmin.profile');
        Route::put('profile/{email}', [SuperAdminController::class, 'profileUpdate'])->name('superadmin.profile.update');
// admin routes inside super admin
        Route::get('superadmins/admins', [SuperAdmin_AdminController::class, 'index'])->name('superadmins.admins.index');
        Route::get('superadmins/admins/pdf', [SuperAdmin_AdminController::class, 'createPDF'])->name('superadmins.admins.pdf');
        Route::get('superadmins/admins/create', [SuperAdmin_AdminController::class, 'create'])->name('superadmins.admins.create');
        Route::get('superadmins/admins/edit/{id}', [SuperAdmin_AdminController::class, 'edit'])->name('superadmins.admins.edit');
        Route::get('superadmins/admins/show/{id}', [SuperAdmin_AdminController::class, 'show'])->name('superadmins.admins.show');
        Route::get('superadmins/admins/status/{id}', [SuperAdmin_AdminController::class, 'changeStatus'])->name('superadmins.admins.status');
        Route::get('superadmins/admins/delete/{id}', [SuperAdmin_AdminController::class, 'destroy'])->name('superadmins.admins.delete');
        Route::post('superadmins/admins/store', [SuperAdmin_AdminController::class, 'store'])->name('superadmins.admins.store');
        Route::put('superadmins/admins/edit/{id}', [SuperAdmin_AdminController::class, 'update'])->name('superadmins.admins.update');
// wholesellers routes inside super admin
        Route::get('superadmins/wholesellers', [SuperAdmin_WholesellerController::class, 'index'])->name('superadmins.wholesellers.index');
        Route::get('superadmins/wholesellers/pdf', [SuperAdmin_WholesellerController::class, 'createPDF'])->name('superadmins.wholesellers.pdf');
        Route::get('superadmins/wholesellers/create', [SuperAdmin_WholesellerController::class, 'create'])->name('superadmins.wholesellers.create');
        Route::get('superadmins/wholesellers/edit/{id}', [SuperAdmin_WholesellerController::class, 'edit'])->name('superadmins.wholesellers.edit');
        Route::get('superadmins/wholesellers/show/{id}', [SuperAdmin_WholesellerController::class, 'show'])->name('superadmins.wholesellers.show');
        Route::get('superadmins/wholesellers/status/{id}', [SuperAdmin_WholesellerController::class, 'changeStatus'])->name('superadmins.wholesellers.status');
        Route::get('superadmins/wholesellers/delete/{id}', [SuperAdmin_WholesellerController::class, 'destroy'])->name('superadmins.wholesellers.delete');
        Route::post('superadmins/wholesellers/store', [SuperAdmin_WholesellerController::class, 'store'])->name('superadmins.wholesellers.store');
        Route::put('superadmins/wholesellers/edit/{id}', [SuperAdmin_WholesellerController::class, 'update'])->name('superadmins.wholesellers.update');
// retailers routes inside super admin
        Route::get('superadmins/retailers', [SuperAdmin_RetailerController::class, 'index'])->name('superadmins.retailers.index');
        Route::get('superadmins/retailers/pdf', [SuperAdmin_RetailerController::class, 'createPDF'])->name('superadmins.retailers.pdf');
        Route::get('superadmins/retailers/create', [SuperAdmin_RetailerController::class, 'create'])->name('superadmins.retailers.create');
        Route::get('superadmins/retailers/edit/{id}', [SuperAdmin_RetailerController::class, 'edit'])->name('superadmins.retailers.edit');
        Route::get('superadmins/retailers/show/{id}', [SuperAdmin_RetailerController::class, 'show'])->name('superadmins.retailers.show');
        Route::get('superadmins/retailers/status/{id}', [SuperAdmin_RetailerController::class, 'changeStatus'])->name('superadmins.retailers.status');
        Route::get('superadmins/retailers/delete/{id}', [SuperAdmin_RetailerController::class, 'destroy'])->name('superadmins.retailers.delete');
        Route::post('superadmins/retailers/store', [SuperAdmin_RetailerController::class, 'store'])->name('superadmins.retailers.store');
        Route::put('superadmins/retailers/edit/{id}', [SuperAdmin_RetailerController::class, 'update'])->name('superadmins.retailers.update');
// shopkeepers routes inside super admin
        Route::get('superadmins/shopkeepers', [SuperAdmin_ShopkeeperController::class, 'index'])->name('superadmins.shopkeepers.index');
        Route::get('superadmins/shopkeepers/pdf', [SuperAdmin_ShopkeeperController::class, 'createPDF'])->name('superadmins.shopkeepers.pdf');
        Route::get('superadmins/shopkeepers/create', [SuperAdmin_ShopkeeperController::class, 'create'])->name('superadmins.shopkeepers.create');
        Route::get('superadmins/shopkeepers/edit/{id}', [SuperAdmin_ShopkeeperController::class, 'edit'])->name('superadmins.shopkeepers.edit');
        Route::get('superadmins/shopkeepers/show/{id}', [SuperAdmin_ShopkeeperController::class, 'show'])->name('superadmins.shopkeepers.show');
        Route::get('superadmins/shopkeepers/status/{id}', [SuperAdmin_ShopkeeperController::class, 'changeStatus'])->name('superadmins.shopkeepers.status');
        Route::get('superadmins/shopkeepers/delete/{id}', [SuperAdmin_ShopkeeperController::class, 'destroy'])->name('superadmins.shopkeepers.delete');
        Route::post('superadmins/shopkeepers/store', [SuperAdmin_ShopkeeperController::class, 'store'])->name('superadmins.shopkeepers.store');
        Route::put('superadmins/shopkeepers/edit/{id}', [SuperAdmin_ShopkeeperController::class, 'update'])->name('superadmins.shopkeepers.update');
// customers routes inside super admin
        Route::get('superadmins/customers', [SuperAdmin_CustomerController::class, 'index'])->name('superadmins.customers.index');
        Route::get('superadmins/customers/pdf', [SuperAdmin_CustomerController::class, 'createPDF'])->name('superadmins.customers.pdf');
        Route::get('superadmins/customers/create', [SuperAdmin_CustomerController::class, 'create'])->name('superadmins.customers.create');
        Route::get('superadmins/customers/edit/{id}', [SuperAdmin_CustomerController::class, 'edit'])->name('superadmins.customers.edit');
        Route::get('superadmins/customers/show/{id}', [SuperAdmin_CustomerController::class, 'show'])->name('superadmins.customers.show');
        Route::get('superadmins/customers/status/{id}', [SuperAdmin_RetailerController::class, 'changeStatus'])->name('superadmins.customers.status');
        Route::get('superadmins/customers/delete/{id}', [SuperAdmin_CustomerController::class, 'destroy'])->name('superadmins.customers.delete');
        Route::post('superadmins/customers/store', [SuperAdmin_CustomerController::class, 'store'])->name('superadmins.customers.store');
        Route::put('superadmins/customers/edit/{id}', [SuperAdmin_CustomerController::class, 'update'])->name('superadmins.customers.update');
// shops routes inside super admin
        Route::get('superadmins/shops', [SuperAdmin_ShopController::class, 'index'])->name('superadmins.shops.index');
        Route::get('superadmins/shops/pdf', [SuperAdmin_ShopController::class, 'createPDF'])->name('superadmins.shops.pdf');
        Route::get('superadmins/shops/create', [SuperAdmin_ShopController::class, 'create'])->name('superadmins.shops.create');
        Route::get('superadmins/shops/edit/{id}', [SuperAdmin_ShopController::class, 'edit'])->name('superadmins.shops.edit');
        Route::get('superadmins/shops/show/{id}', [SuperAdmin_ShopController::class, 'show'])->name('superadmins.shops.show');
        Route::get('superadmins/shops/delete/{id}', [SuperAdmin_ShopController::class, 'destroy'])->name('superadmins.shops.delete');
        Route::get('superadmins/shops/status/{id}', [SuperAdmin_ShopController::class, 'changeStatus'])->name('superadmins.shops.status');
        Route::post('superadmins/shops/store', [SuperAdmin_ShopController::class, 'store'])->name('superadmins.shops.store');
        Route::put('superadmins/shops/edit/{id}', [SuperAdmin_ShopController::class, 'update'])->name('superadmins.shops.update');
// shops routes inside super admin
        Route::get('superadmins/categories', [SuperAdmin_CategoryController::class, 'index'])->name('superadmins.categories.index');
        Route::get('superadmins/categories/pdf', [SuperAdmin_CategoryController::class, 'createPDF'])->name('superadmins.categories.pdf');
        Route::get('superadmins/categories/create', [SuperAdmin_CategoryController::class, 'create'])->name('superadmins.categories.create');
        Route::get('superadmins/categories/edit/{id}', [SuperAdmin_CategoryController::class, 'edit'])->name('superadmins.categories.edit');
        Route::get('superadmins/categories/show/{id}', [SuperAdmin_CategoryController::class, 'show'])->name('superadmins.categories.show');
        Route::get('superadmins/categories/delete/{id}', [SuperAdmin_CategoryController::class, 'destroy'])->name('superadmins.categories.delete');
        Route::get('superadmins/categories/status/{id}', [SuperAdmin_CategoryController::class, 'changeStatus'])->name('superadmins.categories.status');
        Route::post('superadmins/categories/store', [SuperAdmin_CategoryController::class, 'store'])->name('superadmins.categories.store');
        Route::put('superadmins/categories/edit/{id}', [SuperAdmin_CategoryController::class, 'update'])->name('superadmins.categories.update');

// products routes inside super admin
        Route::get('superadmins/products', [SuperAdmin_ProductController::class, 'index'])->name('superadmins.products.index');
        Route::get('superadmins/products/pdf', [SuperAdmin_ProductController::class, 'createPDF'])->name('superadmins.products.pdf');
        Route::get('superadmins/products/create', [SuperAdmin_ProductController::class, 'create'])->name('superadmins.products.create');
        Route::get('superadmins/products/edit/{id}', [SuperAdmin_ProductController::class, 'edit'])->name('superadmins.products.edit');
        Route::get('superadmins/products/show/{id}', [SuperAdmin_ProductController::class, 'show'])->name('superadmins.products.show');
        Route::get('superadmins/products/delete/{id}', [SuperAdmin_ProductController::class, 'destroy'])->name('superadmins.products.delete');
        Route::get('superadmins/products/status/{id}', [SuperAdmin_ProductController::class, 'changeStatus'])->name('superadmins.products.status');
        Route::post('superadmins/products/store', [SuperAdmin_ProductController::class, 'store'])->name('superadmins.products.store');
        Route::put('superadmins/products/edit/{id}', [SuperAdmin_ProductController::class, 'update'])->name('superadmins.products.update');
        Route::post('superadmins/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
    });
});
// Before admin login
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::view('/login', 'admin.auth.login')->name('admin.login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.auth');
    });
    // After admin login
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::get('/users', [AdminController::class, 'create'])->name('admin.users.create');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('profile', [AdminController::class, 'profilePage'])->name('admin.profile');
        Route::put('profile/{email}', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::resource('/users', 'UserController', [
            'names' => [
                'index' => 'users.index',
                'create' => 'users.create',
                'store' => 'users.store',
                'show' => 'users.show',
                'edit' => 'users.edit',
                'update' => 'users.update',
            ]
        ]);
        Route::resource('purchases', 'PurchaseController', [
            'names' => [
                'index' => 'purchases.index',
                'create' => 'purchases.create',
                'store' => 'purchases.store',
                'show' => 'purchases.show',
                'edit' => 'purchases.edit',
                'update' => 'purchases.update',
            ]
        ]);
        Route::get('purchases/{code}/invoice', 'PurchaseController@getInvoice')->name('purchases.invoice');
        Route::get('purchases/{code}/status', 'PurchaseController@changeStatus')->name('purchases.status');
        Route::post('/purchase-products', 'PurchaseController@purchaseProducts')->name('purchase.purchaseProducts');
        Route::get('purchases/{code}/delete', 'PurchaseController@destroy')->name('purchases.delete');

        // return purchases route
        Route::get('/return-purchases/pdf', 'PurchaseReturnController@createPDF')->name('purchaseReturn.pdf');
        Route::resource('return-purchases', 'PurchaseReturnController', [
            'names' => [
                'index' => 'purchaseReturn.index',
                'create' => 'purchaseReturn.create',
                'store' => 'purchaseReturn.store',
                'show' => 'purchaseReturn.show',
                'edit' => 'purchaseReturn.edit',
                'update' => 'purchaseReturn.update',
            ]
        ]);
        Route::get('return-purchases/{code}/status', 'PurchaseReturnController@changeStatus')->name('purchaseReturn.status');
        Route::get('return-purchases/{code}/delete', 'PurchaseReturnController@destroy')->name('purchaseReturn.delete');

        // damage purchases route
        Route::get('/damage-purchases/pdf', 'PurchaseDamageController@createPDF')->name('purchaseDamage.pdf');
        Route::resource('damage-purchases', 'PurchaseDamageController', [
            'names' => [
                'index' => 'purchaseDamage.index',
                'create' => 'purchaseDamage.create',
                'store' => 'purchaseDamage.store',
                'show' => 'purchaseDamage.show',
                'edit' => 'purchaseDamage.edit',
                'update' => 'purchaseDamage.update',
            ]
        ]);
        Route::get('damage-purchases/{code}/status', 'PurchaseDamageController@changeStatus')->name('purchaseDamage.status');
        Route::get('damage-purchases/{code}/delete', 'PurchaseDamageController@destroy')->name('purchaseDamage.delete');

        // purchase inventory route
        Route::get('/purchase-inventory/pdf', 'PurchaseInventoryController@createPDF')->name('purchaseInventory.pdf');
        Route::resource('purchase-inventory', 'PurchaseInventoryController', [
            'names' => [
                'index' => 'purchaseInventory.index',
            ]
        ]);

        // processing products route
        Route::get('/processing-products/pdf', 'ProcessingProductController@createPDF')->name('processing.pdf');
        Route::resource('processing-products', 'ProcessingProductController', [
            'names' => [
                'index' => 'processing.index',
                'create' => 'processing.create',
                'store' => 'processing.store',
                'show' => 'processing.show',
                'edit' => 'processing.edit',
                'update' => 'processing.update',
            ]
        ]);
        Route::get('processing-products/{slug}/status', 'ProcessingProductController@changeStatus')->name('processing.status');
        Route::get('processing-products/{slug}/delete', 'ProcessingProductController@destroy')->name('processing.delete');

        // finished products route
        Route::get('/finished-products/pdf', 'FinishedProductController@createPDF')->name('finished.pdf');
        Route::post('/sizes', 'FinishedProductController@productSizes')->name('finished.sizes');
        Route::post('/finished-purchase-products', 'FinishedProductController@finishedPurchaseProducts')->name('finished.purchase.products');
        Route::resource('finished-products', 'FinishedProductController', [
            'names' => [
                'index' => 'finished.index',
                'create' => 'finished.create',
                'store' => 'finished.store',
                'show' => 'finished.show',
                'edit' => 'finished.edit',
                'update' => 'finished.update',
            ]
        ]);
        Route::get('finished-products/{id}/status', 'FinishedProductController@changeStatus')->name('finished.status');
        Route::get('finished-products/{id}/delete', 'FinishedProductController@destroy')->name('finished.delete');

        // transferred products route
        Route::get('/transferred-products/pdf', 'TransferredProductController@createPDF')->name('transferred.pdf');
        Route::post('/finished-product-sizes', 'TransferredProductController@finishedProductSizes')->name('transferred.finished.sizes');
        Route::resource('transferred-products', 'TransferredProductController', [
            'names' => [
                'index' => 'transferred.index',
                'create' => 'transferred.create',
                'store' => 'transferred.store',
                'show' => 'transferred.show',
                'edit' => 'transferred.edit',
                'update' => 'transferred.update',
            ]
        ]);
        Route::get('transferred-products/{id}/status', 'TransferredProductController@changeStatus')->name('transferred.status');
        Route::get('transferred-products/{id}/delete', 'TransferredProductController@destroy')->name('transferred.delete');


        // purchase report
        Route::get('purchase-report', 'PurchaseReport@purchaseReport')->name('purchase.report');
        Route::post('purchase-report', 'PurchaseReport@postPurchaseReport')->name('purchase.report.post');

        // processing report
        Route::get('processing-report', 'ProductReport@processingReport')->name('processing.report');
        Route::post('processing-report', 'ProductReport@filterProcessingReport')->name('processing.report.filter');

        // finished report
        Route::get('finished-report', 'ProductReport@finishedReport')->name('finished.report');
        Route::post('finished-report', 'ProductReport@filterFinishedReport')->name('finished.report.filter');

        // transferred report
        Route::get('transferred-report', 'ProductReport@transferredReport')->name('transferred.report');
        Route::post('transferred-report', 'ProductReport@filterTransferredReport')->name('transferred.report.filter');
        // categories route
        Route::get('/categories/pdf', 'CategoryController@createPDF')->name('categories.pdf');
        Route::resource('categories', 'CategoryController', [
            'names' => [
                'index' => 'categories.index',
                'create' => 'categories.create',
                'store' => 'categories.store',
                'edit' => 'categories.edit',
                'update' => 'categories.update',
            ]
        ]);
        Route::get('categories/{id}/status', 'CategoryController@changeStatus')->name('categories.status');
        Route::get('categories/{id}/delete', 'CategoryController@destroy')->name('categories.delete');
    });
// sub categories route
    Route::get('/sub-categories/pdf', 'SubCategoryController@createPDF')->name('subCategories.pdf');
    Route::resource('sub-categories', 'SubCategoryController', [
        'names' => [
            'index' => 'subCategories.index',
            'create' => 'subCategories.create',
            'store' => 'subCategories.store',
            'edit' => 'subCategories.edit',
            'update' => 'subCategories.update',
        ]
    ]);
// staff routes
    Route::get('/staff/pdf', 'StaffController@createPDF')->name('staff.pdf');
    Route::resource('staff', 'StaffController', [
        'names' => [
            'index' => 'staff.index',
            'create' => 'staff.create',
            'store' => 'staff.store',
            'show' => 'staff.show',
            'edit' => 'staff.edit',
            'update' => 'staff.update',
        ]
    ]);
    Route::get('staff/{slug}/staus', 'StaffController@changeStatus')->name('staff.status');
    Route::get('staff/{id}/delete', 'StaffController@destroy')->name('staff.delete');

// supplier routes
    Route::get('/suppliers/pdf', 'SupplierController@createPDF')->name('suppliers.pdf');
    Route::resource('suppliers', 'SupplierController', [
        'names' => [
            'index' => 'suppliers.index',
            'create' => 'suppliers.create',
            'store' => 'suppliers.store',
            'show' => 'suppliers.show',
            'edit' => 'suppliers.edit',
            'update' => 'suppliers.update',
        ]
    ]);
    Route::get('suppliers/{id}/status', 'SupplierController@changeStatus')->name('suppliers.status');
    Route::get('suppliers/{id}/delete', 'SupplierController@destroy')->name('suppliers.delete');
// purchases route
    Route::get('/purchases/pdf', 'PurchaseController@createPDF')->name('purchases.pdf');
    Route::resource('purchases', 'PurchaseController', [
        'names' => [
            'index' => 'purchases.index',
            'create' => 'purchases.create',
            'store' => 'purchases.store',
            'show' => 'purchases.show',
            'edit' => 'purchases.edit',
            'update' => 'purchases.update',
        ]
    ]);
    Route::get('purchases/{code}/invoice', 'PurchaseController@getInvoice')->name('purchases.invoice');
    Route::get('purchases/{code}/status', 'PurchaseController@changeStatus')->name('purchases.status');
    Route::post('/purchase-products', 'PurchaseController@purchaseProducts')->name('purchase.purchaseProducts');
    Route::get('purchases/{code}/delete', 'PurchaseController@destroy')->name('purchases.delete');


});


// Before wholeseller login
Route::group(['prefix' => 'wholeseller'], function () {
    Route::group(['middleware' => 'wholeseller.guest'], function () {
        Route::view('/login', 'wholeseller.auth.login')->name('wholeseller.login');
        Route::post('/login', [wholesellerController::class, 'authenticate'])->name('wholeseller.auth');
    });

    // After wholeseller login
    Route::group(['middleware' => 'wholeseller.auth'], function () {
        Route::get('/dashboard', [WholesellerController::class, 'dashboard'])->name('wholeseller.dashboard');
        // Wholesellers general settings
        Route::get('setup', [WholesellerController::class, 'setUpPage'])->name('wholeseller.setup');
        Route::get('generalsettings', [WholesellerController::class, 'generalsettings'])->name('wholeseller.setup.general');
        Route::post('generalsettings', [WholesellerController::class, 'updateGeneralSettings'])->name('wholeseller.setup.general.update');
        // units routes
        Route::resource('units', 'UnitController', [
            'names' => [
                'index' => 'units.index',
                'create' => 'units.create',
                'store' => 'units.store',
                'edit' => 'units.edit',
                'update' => 'units.update'
            ]
        ]);
        Route::get('units/{slug}/staus', 'UnitController@changeStatus')->name('units.status');
        Route::get('units/{slug}/delete', 'UnitController@destroy')->name('units.delete');

        // payment methods routes
        Route::resource('payment-methods', 'PaymentMethodController', [
            'names' => [
                'index' => 'payments.index',
                'create' => 'payments.create',
                'store' => 'payments.store',
                'edit' => 'payments.edit',
                'update' => 'payments.update'
            ]
        ]);
        // processing steps routes
        Route::resource('processing-steps', 'ProcessingStepController', [
            'names' => [
                'index' => 'processing-steps.index',
                'create' => 'processing-steps.create',
                'store' => 'processing-steps.store',
                'edit' => 'processing-steps.edit',
                'update' => 'processing-steps.update'
            ]
        ]);
        // sizes routes
        Route::resource('sizes', 'SizeController', [
            'names' => [
                'index' => 'sizes.index',
                'create' => 'sizes.create',
                'store' => 'sizes.store',
                'edit' => 'sizes.edit',
                'update' => 'sizes.update'
            ]
        ]);
        // showrooms routes
        Route::resource('showrooms', 'ShowroomController', [
            'names' => [
                'index' => 'showrooms.index',
                'create' => 'showrooms.create',
                'store' => 'showrooms.store',
                'show' => 'showrooms.show',
                'edit' => 'showrooms.edit',
                'update' => 'showrooms.update'
            ]
        ]);
        Route::get('/logout', [WholesellerController::class, 'logout'])->name('wholeseller.logout');
        Route::get('profile', [WholesellerController::class, 'profilePage'])->name('wholeseller.profile');
        Route::put('profile/{email}', [WholesellerController::class, 'profileUpdate'])->name('wholeseller.profile.update');
        // retailers routes inside wholeseller
        Route::get('wholeseller/retailers', [Wholeseller_RetailerController::class, 'index'])->name('wholeseller.retailers.index');
        Route::get('wholeseller/retailers/pdf', [Wholeseller_RetailerController::class, 'createPDF'])->name('wholeseller.retailers.pdf');
        Route::get('wholeseller/retailers/create', [Wholeseller_RetailerController::class, 'create'])->name('wholeseller.retailers.create');
        Route::get('wholeseller/retailers/edit/{id}', [Wholeseller_RetailerController::class, 'edit'])->name('wholeseller.retailers.edit');
        Route::get('wholeseller/retailers/show/{id}', [Wholeseller_RetailerController::class, 'show'])->name('wholeseller.retailers.show');
        Route::get('wholeseller/retailers/status/{id}', [Wholeseller_RetailerController::class, 'changeStatus'])->name('wholeseller.retailers.status');
        Route::get('wholeseller/retailers/delete/{id}', [Wholeseller_RetailerController::class, 'destroy'])->name('wholeseller.retailers.delete');
        Route::post('wholeseller/retailers/store', [Wholeseller_RetailerController::class, 'store'])->name('wholeseller.retailers.store');
        Route::put('wholeseller/retailers/edit/{id}', [Wholeseller_RetailerController::class, 'update'])->name('wholeseller.retailers.update');
        // shopkeepers routes inside wholeseller
        Route::get('wholeseller/shopkeepers', [Wholeseller_ShopkeeperController::class, 'index'])->name('wholeseller.shopkeepers.index');
        Route::get('wholeseller/shopkeepers/pdf', [Wholeseller_ShopkeeperController::class, 'createPDF'])->name('wholeseller.shopkeepers.pdf');
        Route::get('wholeseller/shopkeepers/create', [Wholeseller_ShopkeeperController::class, 'create'])->name('wholeseller.shopkeepers.create');
        Route::get('wholeseller/shopkeepers/edit/{id}', [Wholeseller_ShopkeeperController::class, 'edit'])->name('wholeseller.shopkeepers.edit');
        Route::get('wholeseller/shopkeepers/show/{id}', [Wholeseller_ShopkeeperController::class, 'show'])->name('wholeseller.shopkeepers.show');
        Route::get('wholeseller/shopkeepers/delete/{id}', [Wholeseller_ShopkeeperController::class, 'destroy'])->name('wholeseller.shopkeepers.delete');
        Route::post('wholeseller/shopkeepers/store', [Wholeseller_ShopkeeperController::class, 'store'])->name('wholeseller.shopkeepers.store');
        Route::put('wholeseller/shopkeepers/edit/{id}', [Wholeseller_ShopkeeperController::class, 'update'])->name('wholeseller.shopkeepers.update');
        // customers routes inside wholeseller
        Route::get('wholeseller/customers', [Wholeseller_CustomerController::class, 'index'])->name('wholeseller.customers.index');
        Route::get('wholeseller/customers/pdf', [Wholeseller_CustomerController::class, 'createPDF'])->name('wholeseller.customers.pdf');
        Route::get('wholeseller/customers/create', [Wholeseller_CustomerController::class, 'create'])->name('wholeseller.customers.create');
        Route::get('wholeseller/customers/edit/{id}', [Wholeseller_CustomerController::class, 'edit'])->name('wholeseller.customers.edit');
        Route::get('wholeseller/customers/show/{id}', [Wholeseller_CustomerController::class, 'show'])->name('wholeseller.customers.show');
        Route::get('wholeseller/customers/status/{id}', [Wholeseller_RetailerController::class, 'changeStatus'])->name('wholeseller.customers.status');
        Route::get('wholeseller/customers/delete/{id}', [Wholeseller_CustomerController::class, 'destroy'])->name('wholeseller.customers.delete');
        Route::post('wholeseller/customers/store', [Wholeseller_CustomerController::class, 'store'])->name('wholeseller.customers.store');
        Route::put('wholeseller/customers/edit/{id}', [Wholeseller_CustomerController::class, 'update'])->name('wholeseller.customers.update');
        // shops routes inside wholeseller
        Route::get('wholeseller/shops', [Wholeseller_ShopController::class, 'index'])->name('wholeseller.shops.index');
        Route::get('wholeseller/shops/pdf', [Wholeseller_ShopController::class, 'createPDF'])->name('wholeseller.shops.pdf');
        Route::get('wholeseller/shops/create', [Wholeseller_ShopController::class, 'create'])->name('wholeseller.shops.create');
        Route::get('wholeseller/shops/edit/{id}', [Wholeseller_ShopController::class, 'edit'])->name('wholeseller.shops.edit');
        Route::get('wholeseller/shops/show/{id}', [Wholeseller_ShopController::class, 'show'])->name('wholeseller.shops.show');
        Route::get('wholeseller/shops/delete/{id}', [Wholeseller_ShopController::class, 'destroy'])->name('wholeseller.shops.delete');
        Route::get('wholeseller/shops/status/{id}', [Wholeseller_ShopController::class, 'changeStatus'])->name('wholeseller.shops.status');
        Route::post('wholeseller/shops/store', [Wholeseller_ShopController::class, 'store'])->name('wholeseller.shops.store');
        Route::put('wholeseller/shops/edit/{id}', [Wholeseller_ShopController::class, 'update'])->name('wholeseller.shops.update');
        // shops routes inside wholesellers
        Route::get('wholeseller/categories', [Wholeseller_CategoryController::class, 'index'])->name('wholeseller.categories.index');
        Route::get('wholeseller/categories/pdf', [Wholeseller_CategoryController::class, 'createPDF'])->name('wholeseller.categories.pdf');
        Route::get('wholeseller/categories/create', [Wholeseller_CategoryController::class, 'create'])->name('wholeseller.categories.create');
        Route::get('wholeseller/categories/edit/{id}', [Wholeseller_CategoryController::class, 'edit'])->name('wholeseller.categories.edit');
        Route::get('wholeseller/categories/show/{id}', [Wholeseller_CategoryController::class, 'show'])->name('wholeseller.categories.show');
        Route::get('wholeseller/categories/delete/{id}', [Wholeseller_CategoryController::class, 'destroy'])->name('wholeseller.categories.delete');
        Route::get('wholeseller/categories/status/{id}', [Wholeseller_CategoryController::class, 'changeStatus'])->name('wholeseller.categories.status');
        Route::post('wholeseller/categories/store', [Wholeseller_CategoryController::class, 'store'])->name('wholeseller.categories.store');
        Route::put('Wholeseller/categories/edit/{id}', [Wholeseller_CategoryController::class, 'update'])->name('wholeseller.categories.update');

        // products routes inside wholeseller
        Route::get('wholeseller/products', [Wholeseller_ProductController::class, 'index'])->name('wholeseller.products.index');
        Route::get('wholeseller/products/pdf', [Wholeseller_ProductController::class, 'createPDF'])->name('wholeseller.products.pdf');
        Route::get('wholeseller/products/create', [Wholeseller_ProductController::class, 'create'])->name('wholeseller.products.create');
        Route::get('wholeseller/products/edit/{id}', [Wholeseller_ProductController::class, 'edit'])->name('wholeseller.products.edit');
        Route::get('wholeseller/products/show/{id}', [Wholeseller_ProductController::class, 'show'])->name('wholeseller.products.show');
        Route::get('wholeseller/products/delete/{id}', [Wholeseller_ProductController::class, 'destroy'])->name('wholeseller.products.delete');
        Route::get('wholeseller/products/status/{id}', [Wholeseller_ProductController::class, 'changeStatus'])->name('wholeseller.products.status');
        Route::post('wholeseller/products/store', [Wholeseller_ProductController::class, 'store'])->name('wholeseller.products.store');
        Route::put('wholeseller/products/edit/{id}', [Wholeseller_ProductController::class, 'update'])->name('wholeseller.products.update');

    });
});

// Before retailer login
Route::group(['prefix' => 'retailer'], function () {
    Route::group(['middleware' => 'retailer.guest'], function () {
        Route::view('/login', 'retailer.auth.login')->name('retailer.login');
        Route::post('/login', [RetailerController::class, 'authenticate'])->name('retailer.auth');
    });
    // After retailer login
    Route::group(['middleware' => 'retailer.auth'], function () {
        Route::get('/dashboard', [RetailerController::class, 'dashboard'])->name('retailer.dashboard');
        Route::get('/logout', [RetailerController::class, 'logout'])->name('retailer.logout');
        Route::get('profile', [RetailerController::class, 'profilePage'])->name('retailer.profile');
        Route::put('profile/{email}', [RetailerController::class, 'profileUpdate'])->name('retailer.profile.update');
    });
});

// Before shopkeeper login
Route::group(['prefix' => 'shopkeeper'], function () {
    Route::group(['middleware' => 'shopkeeper.guest'], function () {
        Route::view('/login', 'shopkeeper.auth.login')->name('shopkeeper.login');
        Route::post('/login', [ShopkeeperController::class, 'authenticate'])->name('shopkeeper.auth');
    });

    // After shopkeeper login
    Route::group(['middleware' => 'shopkeeper.auth'], function () {
        Route::get('/dashboard', [ShopkeeperController::class, 'dashboard'])->name('shopkeeper.dashboard');
        Route::get('/logout', [ShopkeeperController::class, 'logout'])->name('shopkeeper.logout');
        Route::get('profile', [ShopkeeperController::class, 'profilePage'])->name('shopkeeper.profile');
        Route::put('profile/{email}', [ShopkeeperController::class, 'profileUpdate'])->name('shopkeeper.profile.update');
    });
});

// Before customer login
Route::group(['prefix' => 'customer'], function () {
    Route::group(['middleware' => 'customer.guest'], function () {
        Route::view('/login', 'customer.auth.login')->name('customer.login');
        Route::post('/login', [CustomerController::class, 'authenticate'])->name('customer.auth');
    });

    // After customer login
    Route::group(['middleware' => 'customer.auth'], function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
        Route::get('profile', [CustomerController::class, 'profilePage'])->name('customer.profile');
        Route::put('profile/{email}', [CustomerController::class, 'profileUpdate'])->name('customer.profile.update');
    });
});
