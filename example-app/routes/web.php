<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
//product
Route::get('/product',[ ProductController::class, 'index']);
Route::get('/product/create',[ ProductController::class, 'create']);
Route::post('/product/create',[ ProductController::class, 'store']);
Route::get('/product/{id}/delete',[ ProductController::class, 'destroy']);
Route::get('/product/{id}/edit',[ ProductController::class, 'edit']);
Route::post('/product/{id}/edit',[ ProductController::class, 'update']);
//category
Route::get('/category',[ CategoryController::class,'index']);
Route::get('/category/create',[ CategoryController::class, 'create']);
Route::post('/category/create',[ CategoryController::class, 'store']);
Route::get('/category/{id}/delete',[ CategoryController::class, 'destroy']);
Route::get('/category/{id}/edit',[ CategoryController::class, 'edit']);
Route::post('/category/{id}/edit',[ CategoryController::class, 'update']);

