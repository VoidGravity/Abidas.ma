<?php

use App\Http\Controllers\AuthentificationContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/product', function () {
//     return view('products.index');
// });
// Route::get('/product/create', function () {
//     return view('products.create');
// });

//new hting to learn : 
// Route::controller(AuthentificationContoller::class)->prefix('/login')->group(function(){
//     Route::get('/',[AuthentificationContoller::class,"login"])->name('auth.login');
//     Route::post('/',[AuthentificationContoller::class,"check"])->name('auth.login');
// });

// Route::group(['middleware' => 'guest'], function () {
    //auth
    // Route::get('/login', [AuthentificationContoller::class, "login"])->name('auth.login');
    Route::get('/login', [AuthentificationContoller::class, "login"])->name('login');
    Route::post('/login', [AuthentificationContoller::class, "check"])->name('auth.login');
    Route::get('/resetPassword', [AuthentificationContoller::class, "ShowReset"])->name('auth.resetPassword');
    Route::post('/resetPassword', [AuthentificationContoller::class, "ResetPassord"])->name('resetPassword');
    Route::get('/register', [AuthentificationContoller::class, "register"])->name('auth.signin');
    Route::post('/register', [AuthentificationContoller::class, "store"]);
// });
// Route::group(['middleware' => 'auth'], function () {


    //permissions 
    Route::get('/permission', [permissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/create', [permissionController::class, 'create']);
    Route::post('/permission/create', [permissionController::class, 'store']);
    Route::get('/permission/{id}/edit', [permissionController::class, 'edit']);
    Route::post('/permission/{id}/edit', [permissionController::class, 'update']);
    Route::get('/permission/{id}/delete', [permissionController::class, 'destroy']);
    //role
    Route::get('/role', [roleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [roleController::class, 'create']);
    Route::post('/role/create', [roleController::class, 'store']);
    Route::get('/role/{id}/edit', [roleController::class, 'edit'])->name('role.edit');
    Route::post('/role/{id}/edit', [roleController::class, 'update']);
    Route::get('/role/{id}/delete', [roleController::class, 'destroy']);
    //product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/create', [ProductController::class, 'store']);
    Route::get('/product/{id}/delete', [ProductController::class, 'destroy']);
    Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
    Route::post('/product/{id}/edit', [ProductController::class, 'update']);
    //category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category/create', [CategoryController::class, 'store']);
    Route::get('/category/{id}/delete', [CategoryController::class, 'destroy']);
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::post('/category/{id}/edit', [CategoryController::class, 'update']);

    //selles
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sale.create');
    Route::post('/sales/create', [SaleController::class, 'store'])->name('sale.create');
    Route::get('/sales/{id}/delete', [SaleController::class, 'destroy']);
    Route::get('/sales/{id}/edit', [SaleController::class, 'edit']);
    Route::post('/sales/{id}/edit', [SaleController::class, 'update'])->name('sales.edit');
    //clients
    Route::get('/client', [UserController::class, 'index'])->name('client.index');
    //search
    Route::post('/search', [ProductController::class, 'search']);
    // Route::get('/search', [ProductController::class, 'liveSearch']);

    //auth
    Route::delete('/logout', [AuthentificationContoller::class, 'logout'])->name('logout');
// });
