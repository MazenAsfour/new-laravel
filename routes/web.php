<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationController;
use App\Models\NotificationRequest; // Update the namespace based on your model location
use App\Http\Controllers\PasswordController;

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

// routes/web.php


Route::get('/addPoints/{userid}', [PasswordController::class, 'showPasswordForm']);
Route::post('/addPoints/{userid}', [PasswordController::class, 'verifyPassword'])->name('addPoints');

Route::get('/fetch-notifications', [NotificationController::class, 'fetchNotifications']);
Route::get('/markAsReadByUser/', [NotificationController::class, 'markAsReadByUser']);
Route::get('/fetch-unread-notification-count', [NotificationController::class, 'fetchUnreadNotificationCount']);
Route::get('/mark-as-read', [NotificationController::class, 'markReaded']);


Route::get('/',[App\Http\Controllers\PublicController::class, 'welcome_view']);

Route::get('/contact',[App\Http\Controllers\PublicController::class, 'contact_view']);

Route::post('/contact-message',[App\Http\Controllers\PublicController::class, 'contact_message']);
Route::post('/save-request',[App\Http\Controllers\PublicController::class, 'save_request']);



// Dashborad Routes
Route::middleware(['dashboardAccess'])->group(function () {
    Route::get('/dashboard/products/data', [App\Http\Controllers\AdminController::class, 'getProdcuts'])->name('products.data');
    Route::get('/dashboard-category/data', [App\Http\Controllers\AdminController::class, 'getCategories'])->name('category.data');
    Route::get('/dashboard-points/data', [App\Http\Controllers\AdminController::class, 'getPoints'])->name('points.data');

    Route::get('/dashboard-users/plus', [App\Http\Controllers\AdminController::class, 'getUsersPlusPoints'])->name('users-plus.data');
    Route::get('/dashboard-users/data', [App\Http\Controllers\AdminController::class, 'getUsers'])->name('users.data');

    Route::post('/dashboard-all-requests-reads',[App\Http\Controllers\AdminController::class, 'make_all_requests_read']);
    Route::post('/dashboard-update-password-points',[App\Http\Controllers\AdminController::class, 'update_password_points']);

    Route::post('/dashboard-set-options',[App\Http\Controllers\AdminController::class, 'update_options']);

    Route::get('/dashboard',[App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/dashboard-users',[App\Http\Controllers\AdminController::class, 'users']);
    Route::get('/dashboard-users-plus',[App\Http\Controllers\AdminController::class, 'users_plus']);

    Route::post('/dashboard-create-user',[App\Http\Controllers\AdminController::class, 'create_user']);

    Route::post('/dashboard-update-user',[App\Http\Controllers\AdminController::class, 'update_user']);
    Route::post('/dashboard-delete-user',[App\Http\Controllers\AdminController::class, 'delete_user']);
    Route::get('/dashboard-admin-profile',[App\Http\Controllers\AdminController::class, 'admin_profile']);
    Route::get('/dashboard-check-password',[App\Http\Controllers\AdminController::class, 'check_password']);
    Route::get('/dashboard-products',[App\Http\Controllers\AdminController::class, 'products']);
    Route::get('/dashboard-categories',[App\Http\Controllers\AdminController::class, 'categories']);
    Route::get('/dashboard-points',[App\Http\Controllers\AdminController::class, 'points']);

    Route::post('/dashboard-add-product',[App\Http\Controllers\AdminController::class, 'add_product']);
    Route::post('/dashboard-update-product',[App\Http\Controllers\AdminController::class, 'update_product']);
    Route::post('/dashboard-delete-product',[App\Http\Controllers\AdminController::class, 'delete_product']);

    Route::post('/dashboard-update-status',[App\Http\Controllers\AdminController::class, 'update_status']);
    
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

// Route::auth(['register' => false]);

Auth::routes();

Route::get('/profile', [App\Http\Controllers\PublicController::class, 'profile'])->middleware('auth');
Route::post('/user-update-card', [App\Http\Controllers\PublicController::class, 'update_card'])->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/menu', function () {
    return view('menu');
}); 


// start  menuuuuuuuuuuuuu

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/get-products/{category}', [MenuController::class, 'getProducts']);