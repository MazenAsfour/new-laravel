<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/',[App\Http\Controllers\PublicController::class, 'welcome_view']);

Route::get('/contact',[App\Http\Controllers\PublicController::class, 'contact_view']);

Route::post('/contact-message',[App\Http\Controllers\PublicController::class, 'contact_message']);



// Dashborad Routes
Route::middleware(['dashboardAccess'])->group(function () {
    Route::get('/dashboard/products/data', [App\Http\Controllers\AdminController::class, 'getProdcuts'])->name('products.data');
    Route::get('/dashboard-category/data', [App\Http\Controllers\AdminController::class, 'getCategories'])->name('category.data');

    Route::get('/dashboard-users/data', [App\Http\Controllers\AdminController::class, 'getUsers'])->name('users.data');

    Route::get('/dashboard',[App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/dashboard-users',[App\Http\Controllers\AdminController::class, 'users']);
    Route::post('/dashboard-create-user',[App\Http\Controllers\AdminController::class, 'create_user']);

    Route::post('/dashboard-update-user',[App\Http\Controllers\AdminController::class, 'update_user']);
    Route::post('/dashboard-delete-user',[App\Http\Controllers\AdminController::class, 'delete_user']);
    Route::get('/dashboard-admin-profile',[App\Http\Controllers\AdminController::class, 'admin_profile']);
    Route::get('/dashboard-check-password',[App\Http\Controllers\AdminController::class, 'check_password']);
    Route::get('/dashboard-products',[App\Http\Controllers\AdminController::class, 'products']);
    Route::get('/dashboard-categories',[App\Http\Controllers\AdminController::class, 'categories']);

    Route::post('/dashboard-add-product',[App\Http\Controllers\AdminController::class, 'add_product']);
    Route::post('/dashboard-update-product',[App\Http\Controllers\AdminController::class, 'update_product']);
    Route::post('/dashboard-delete-product',[App\Http\Controllers\AdminController::class, 'delete_product']);

    Route::post('/dashboard-add-category',[App\Http\Controllers\AdminController::class, 'add_category']);
    Route::post('/dashboard-update-category',[App\Http\Controllers\AdminController::class, 'update_category']);
    Route::post('/dashboard-delete-category',[App\Http\Controllers\AdminController::class, 'delete_category']);
    Route::get('/dashboard-single-product/{id}',[App\Http\Controllers\AdminController::class, 'single_product']);

    Route::get('/dashboard-contact',[App\Http\Controllers\AdminController::class, 'contact']);
    Route::post('/dashboard-send-contact',[App\Http\Controllers\sendEmail::class, 'sendContactMailAdmin']);
    Route::get('/dashboard-get-unread-contact',[App\Http\Controllers\AdminController::class, 'get_unread_message']);
    Route::get('/dashboard-mark-as-read',[App\Http\Controllers\AdminController::class, 'mark_as_read']);
    Route::get('/dashboard-notifications',[App\Http\Controllers\AdminController::class, 'get_notifications']);
    Route::get('/dashboard-notifications-image/{id}',[App\Http\Controllers\AdminController::class, 'get_notifications_image']);
    Route::get('/dashboard-count-notifications',[App\Http\Controllers\AdminController::class, 'get_notifications_count']);
    Route::get('/dashboard-read-notifications',[App\Http\Controllers\AdminController::class, 'update_read_notifications']);
    Route::get('/dashboard-admins',[App\Http\Controllers\AdminController::class, 'dashboard_admins']);
    Route::post('/dashborad-modify-admin',[App\Http\Controllers\AdminController::class, 'modifiyAdmin']);
    Route::post('/dashboard-add-admin',[App\Http\Controllers\AdminController::class, 'add_new_admin']);
});
// End Dashborad Routes


Route::get('/test',[App\Http\Controllers\AdminController::class, "test"]);



// Upload Image Routes
Route::post('upload-image', [App\Http\Controllers\AjaxUploadController::class, 'store']);
Route::post('/upload-image-user',[App\Http\Controllers\AjaxUploadController::class, 'store_user']);

// End Upload Image Routes

Route::auth(['register' => false]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
 
