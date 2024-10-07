<?php
 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController ;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Artisan;



Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::group(["middleware" => ["auth:sanctum"]], function(){
    //==========Logout=============
    Route::post('/logout',[AuthController::class,'logout']);
    //==========Product============
    //Show_all | Create | Update |Delete | Show_one
    Route::get('/all-products' , [ProductController::class , 'index']);
    Route::Post('/create-product' , [ProductController::class , 'store']);
    Route::get('/show-one-product/{id}' , [ProductController::class , 'show']);
    Route::delete('/delete-product/{id}' , [ProductController::class , 'destroy']);
    Route::post('/edit-product/{id}' , [ProductController::class , 'update']);
    //this is an api to show last four products
    Route::get('/lastFour',[ProductController::class,'lastFour']);
    //Search for a product
    Route::get('/products/search/{name}' , [ProductController::class , 'search']);
    //Check if you have products
    Route::get('/my_products',[ProductController::class,'my_products']);
    //====================Favorite=============================
    //Show Favorite Products for this user(Authenticated User)
    Route::get('/favorite',[FavoriteController::class,'my_favorites']);
    //Love Button=>if not fav make it |if fav make it not
    Route::get('/love_button/{product_id}',[FavoriteController::class,'change_to']);
    //============Reviews=============
    //Authenticated User Reviews (Reviews On My profile)
    Route::get('/user_reviews',[ReviewController::class,'my_reviews']);
    //Reviews On Other People Profiles
    Route::get('/others_reviews/{user_id}',[ReviewController::class,'people_reviews']);
    //Review a User --------Add A review
    Route::Post('/reviews/{user_id}' , [ReviewController::class , 'add_review']);
    //Check if you reviewed user with use_id or not
    Route::get('/reviews/{user_id}' , [ReviewController::class ,'review_check']);
    //Update Review
    Route::put('/reviews/{review_id}',[ReviewController::class,'update_review']);
    //Delete Review:
    Route::delete('/reviews/{review_id}',[ReviewController::class,'destroy']);
    //=============Profile============
    //Show Auth_User Profile
    Route::get('/auth_profile',[UserProfileController::class,'show_info']);
    //Update Auth_User Profile
    Route::put('/auth_profile',[UserProfileController::class,'update_info']);
    //Show other users info
    Route::get('/profile/{id}',[UserProfileController::class,'show_user_info']);
    //=============comments============
    //show all comments to a specific product
    Route::get('/products/{product_id}/Comments' , [CommentController::class , 'index']);
    //create new product
    Route::Post('/products/{product_id}/Comments' , [CommentController::class , 'store']);
    //show a comment
    Route::get('/products/{product_id}/Comments/{comment_id}' , [CommentController::class , 'show']);
   //??????????????????????Update?????????????????????
    //show my comment on this product(so i can add one if not existed)
   //and i can update an delete an existed comment
    Route::get('/products/{product_id}/Comment-Check/{user_id}' , [CommentController::class , 'comment_check']);
    //delete a comment
    Route::delete('/products/{product_id}/delete-Comment/{comment_id}' , [CommentController::class , 'destroy']);
    //edit a comment
    Route::put('/products/{product_id}/update-Comments/{comment_id}' , [CommentController::class , 'update']);
    //=================Orders===================
    //when hitting 'Order Now' this should be implemented
    Route::post('/add_order',[OrderController::class,'add_order']);
    //Deleting ordered products from the market after they have been ordered
    Route::delete('/delete_order/{order_id}',[OrderController::class,'delete_form_market']);
    //Show My orders:
    Route::get('/show_orders',[OrderController::class,'show_orders']);
});


//Admin Routes

//login
Route::post('/admin/login',[AdminAuthController::class,'login']);

Route::group(["middleware" => ["auth:sanctum"]], function(){

//logout
Route::post('/admin/logout',[AdminAuthController::class,'logout']);
//products APIs:

//show pending products
Route::get('/admin/pending_products',[AdminController::class,'pending_products_index']);
//show active products
Route::get('/admin/active_products',[AdminController::class,'active_products_index']);
//approving a product
Route::post('/admin/approve_product/{product_id}',[AdminController::class,'approve_product']);
//rejecting a product and deleting it
Route::post('/admin/reject_product/{product_id}',[AdminController::class,'reject_product']);

//orders APIs:

//show pending orders
Route::get('/admin/pending_orders',[AdminController::class,'pending_orders_index']);
//show active orders
Route::get('/admin/active_orders',[AdminController::class,'active_orders_index']);
//show an order's details
Route::get('/admin/order_details/{order_id}',[AdminController::class,'order_details']);
//approving a order
Route::post('/admin/approve_order/{order_id}',[AdminController::class,'approve_order']);
//rejecting a order and deleting it
Route::post('/admin/reject_order/{order_id}',[AdminController::class,'reject_order']);

//users APIs:

//show all users
Route::get('/admin/all_users',[AdminController::class,'users_index']);
//show active users (who selled at least a product)
Route::get('/admin/seller_users',[AdminController::class,'seller_users_index']);
//show a user's details
Route::get('/admin/user_details/{user_id}',[AdminController::class,'user_details']);
//ban a user
Route::post('/admin/ban_user/{user_id}',[AdminController::class,'ban_user']);
});


