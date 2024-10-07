<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\dashboard\DashboardController;
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
// Route Dashboard Directory
Route::get('/', function (){
    $title = 'index';
    return view('dashboard.index', ['title' => $title]);
})->middleware(['auth:admin'])->name('index');


Route::controller(DashboardController::class)->prefix('admin')->middleware(['auth:admin'])->group(function (){


    Route::get('/products','products')->name('products');
    Route::get('/app-user-list', 'appUserList')->name('app-user-list');
    //approving a product
    Route::get('/approve_product/{product_id}','approveProduct')->name('approve_product');
    //rejecting a product and deleting it
    Route::get('/reject_product/{product_id}','reject_product')->name('reject_product');


    //orders APIs:

//show pending orders
    Route::get('/orders','orders')->name('orders');
    //show active orders
    Route::get('/active_orders','active_orders_index')->name('active_orders');
    //show an order's details


//    show with modal in orders page
//    Route::get('/order_details/{order_id}','order_details');
    //approving a order
    Route::get('/approve_order/{order_id}','approve_order')->name('approve_order');

    //rejecting a order and deleting it
    Route::get('/reject_order/{order_id}','reject_order')->name('reject_order');
    //show all users
    Route::get('/all_users','users_index')->name('all_users');

    //show active users (who selled at least a product)
    Route::get('/seller_users','seller_users_index')->name('seller_users');

    //show a user's details
    Route::get('/user_details/{user_id}','user_details');

    //ban a user
    Route::get('/ban_user/{user_id}','ban_user')->name('ban_user');







});



require __DIR__.'/auth.php';
