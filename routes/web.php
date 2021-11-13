<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
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
 */

Route::get('/', function () {

    return view('admin\auth\login');
});
Route::get('/register', function () {

    return view('admin\auth\register');
});

Auth::routes();

// Only use auth and product route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('pass', [AdminController::class, 'index'])->name('secpass');
Route::post('adminRegister', [AdminController::class, 'register'])->name('admin_register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('update', [AdminController::class, 'update'])->name('update_profile');
    Route::get('user-create', [AdminController::class, 'user_create'])->name('user_create');

    // admin ajax blockunblock create
    Route::post('active-inactive', [AdminController::class, 'status']);
    //user menus access
    Route::get('/user-access', [AdminController::class, 'useraccess'])->name('user-access');
    Route::post('/get_menu_list', [AdminController::class, 'get_menu_list'])->name('get_menu_list');
    Route::post('/insert_menu_accessList', [AdminController::class, 'insert_menu_accessList'])->name('insert_menu_accessList');
    Route::get('/adminMenu', [AdminController::class, 'adminMenu'])->name('adminMenu');
    Route::post('/storeMenu', [AdminController::class, 'storeMenu'])->name('storeMenu');
    
   
    // user access
    Route::get('usercreate', [AdminController::class, 'usercreate'])->name('usercreate');
    Route::post('storeuser', [AdminController::class, 'storeuser'])->name('storeuser');
    Route::get('/user-access', [AdminController::class, 'useraccess'])->name('user-access');

    // Company
    Route::post('/edit', [ProductController::class, 'update'])->name('edit_product');
    Route::get('/company', [CompanyController::class, 'create'])->name('company');
    Route::post('updateCompanyInfos', [CompanyController::class, 'updateCompanyInfos'])->name('updateCompanyInfos');
    

    // rabbi admin password change
    Route::get('admin_password_change', [AdminController::class, 'password_change'])->name('admin_password_change');
    Route::post('updateuserpassword', [AdminController::class, 'update_password'])->name('updateuserpassword');
});
