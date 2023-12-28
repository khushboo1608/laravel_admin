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
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    Route::middleware('is_admin')->group( function () { 
        Route::get('/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('home');

         //profile
         Route::get('/profile',[App\Http\Controllers\Admin\AdminHomeController::class, 'profile'])->name('admin.profile');
         Route::post('/update_profile',[App\Http\Controllers\Admin\AdminHomeController::class, 'update_profile'])->name('admin.update-profile');
         Route::post('/check_old_password',[App\Http\Controllers\Admin\AdminHomeController::class, 'check_old_password'])->name('admin.check-old-password');
         Route::post('/change_password',[App\Http\Controllers\Admin\AdminHomeController::class, 'change_password'])->name('admin.change-password');

         //Settings
         Route::get('/setting',[App\Http\Controllers\Admin\AdminSettingController::class, 'index'])->name('admin.setting');
         Route::post('setting/savepagesetting',[App\Http\Controllers\Admin\AdminSettingController::class,'SavePageSetting'])->name('setting.savepagesetting');
         Route::get('/generalsetting',[App\Http\Controllers\Admin\AdminSettingController::class,'GeneralSetting'])->name('admin.generalsetting');
         Route::post('setting/savegeneral',[App\Http\Controllers\Admin\AdminSettingController::class,'SaveGeneral'])->name('setting.savegeneral');

         //usercheck_old_password
         Route::get('/user',[App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.user');
         Route::post('/change_status',[App\Http\Controllers\Admin\AdminUserController::class, 'change_status'])->name('admin.change_status');
         Route::get('user/edit/{id}',   [App\Http\Controllers\Admin\AdminUserController::class, 'user_data_edit'])->name('userdataedit');
         Route::post('user/saveuser',[App\Http\Controllers\Admin\AdminUserController::class, 'saveuser'])->name('user.saveuser');
         Route::post('/user_delete',[App\Http\Controllers\Admin\AdminUserController::class,'user_delete'])->name('admin.userdelete');
         Route::get('/user/add',[App\Http\Controllers\Admin\AdminUserController::class,'add_user'])->name('admin.adduser');

         //vendor
         Route::get('/vendor',[App\Http\Controllers\Admin\AdminVendorController::class, 'index'])->name('admin.vendor');
         Route::post('/feature_vendor',[App\Http\Controllers\Admin\AdminVendorController::class, 'feature_vendor'])->name('admin.feature_vendor');
         Route::post('/status_vendor',[App\Http\Controllers\Admin\AdminVendorController::class, 'status_vendor'])->name('admin.status_vendor');
         Route::get('/vendor/add',[App\Http\Controllers\Admin\AdminVendorController::class, 'add_vendor'])->name('admin.addvendor');
         Route::post('/vendor/savevendor',[App\Http\Controllers\Admin\AdminVendorController::class, 'savevendor'])->name('vendor.savevendor');
         Route::get('vendor/edit/{id}',   [App\Http\Controllers\Admin\AdminVendorController::class, 'vendor_data_edit'])->name('vendordataedit');
         
        });
});