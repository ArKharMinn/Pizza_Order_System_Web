<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Order_list;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Contact;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//login Register

Route::middleware(['auth_admin'])->group(function () {
    Route::redirect('/','login');
    Route::get('login',[AuthController::class,'login'])->name('auth#login');
    Route::get('register',[AuthController::class,'register'])->name('auth#register');
});

Route::middleware(['auth'])->group(function () {
 //category

 //dashboard
 Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

//admin
 Route::prefix('category')->middleware('auth_admin')->group(function () {
    Route::get('list',[CategoryController::class,'list'])->name('category#list');

    //categotyCreate
    Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    //delete
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    //update
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');

});

//admin order list
Route::prefix('order')->middleware('auth_admin')->group(function(){
    Route::get('list',[OrderController::class,'list'])->name('order#list');
    //sorting status
    Route::get('status',[OrderController::class,'status'])->name('order#status');
    //change status
    Route::get('change',[OrderController::class,'change'])->name('order#change');
    //order code voucher
    Route::get('voucher/{code}',[OrderController::class,'voucher'])->name('order#voucher');
});

//admin
Route::prefix('admin')->middleware('auth_admin')->group(function() {
    //password
    Route::get('password',[AuthController::class,'password'])->name('admin#password');
    Route::post('changePassword',[AuthController::class,'changePassword'])->name('admin#changePassword');

    //account detail
    Route::get('account',[AdminController::class,'account'])->name('admin#account');

    //user list
    Route::get('userList',[AdminController::class,'userList'])->name('admin#userList');
    //user delete
    Route::get('userDelete',[AdminController::class,'userDelete'])->name('admin#userDelete');
    //user role change
    Route::get('userRole',[AdminController::class,'userRole'])->name('admin#userRole');

    //account edit
    Route::get('editAccount',[AdminController::class,'editAccount'])->name('admin#edit');
    Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

    //admin list
    Route::get('list',[AdminController::class,'list'])->name('admin#list');
    //delete
    Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
    //role change
    Route::get('changeRole',[AdminController::class,'changeRole'])->name('admin#changeRole');
    //inbox
    Route::get('inbox',[AdminController::class,'inbox'])->name('admin#inbox');
    //inbox delete
    Route::get('inboxDelete',[AdminController::class,'inboxDelete'])->name('admin#inboxDelete');
    //inbox detail
    Route::get('message/{id}',[AdminController::class,'message'])->name('admin#message');
    //inbox message delete
    Route::get('messageDelete',[AdminController::class,'messageDelete'])->name('admin#messageDelete');
});

//product

Route::prefix('product')->middleware('auth_admin')->group(function(){
    //productlist
    Route::get('list',[ProductController::class,'list'])->name('product#list');
    //productcreate
    Route::get('create',[ProductController::class,'create'])->name('product#create');
    Route::post('createPizza',[ProductController::class,'createPizza'])->name('product#createPizza');
    //productupdate
    Route::get('updatePizza/{id}',[ProductController::class,'updatePizza'])->name('product#updatePizza');
    Route::post('update,{id}',[ProductController::class,'update'])->name('product#update');
    //delete pizza
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#deletePizza');
    //view pizza
    Route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
});

//user
Route::prefix('user')->middleware('auth_user')->group(function() {
    Route::get('home',[UserController::class,'home'])->name('user#home');
    //history
    Route::get('history',[UserController::class,'history'])->name('user#history');
    //category filter
    Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
    //contact form
    Route::post('contact',[UserController::class,'contact'])->name('user#contact');

    Route::prefix('cart')->group(function(){
        //product detail
        Route::get('detail/{id}',[UserController::class,'detail'])->name('pizza#detail');
        //cart list
        Route::get('cartList',[UserController::class,'cartList'])->name('cart#list');
    });

    //password
    Route::prefix('password')->group(function(){
      Route::get('change',[UserController::class,'change'])->name('user#change');
      Route::post('change',[UserController::class,'changePassword'])->name('user#passwordChange');
    });
    //acc update
    Route::prefix('account')->group(function(){
      Route::get('view',[UserController::class,'view'])->name('user#view');
      Route::post('update/{id}',[UserController::class,'update'])->name('user#update');
    });

    Route::prefix('ajax')->group(function(){
      Route::get('priceList',[AjaxController::class,'priceList'])->name('ajax#priceList');
      //cart
      Route::get('cart',[AjaxController::class,'cart'])->name('ajax#cart');
      //order
      Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
      //clear cart
      Route::get('clear',[AjaxController::class,'clear'])->name('ajax#clear');
      //delete one cart
      Route::get('delete',[AjaxController::class,'deleteCart'])->name('ajax#delete');
      //view count
      Route::get('viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
    });
 });
});

