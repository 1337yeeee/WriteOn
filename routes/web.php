<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AddingController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\CheckAdminPermission;

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

Route::get('/', [IndexController::class, 'index']);

Route::get('/signup', function () {
    return view('sign/signup');
});

Route::post('/signup', [AuthController::class, 'register']);

Route::get('/product/{product_id}', [ProductController::class, 'index'])->name('product');

Route::get('/signin', function () {
    return view('sign/signin');
});

Route::post('/signin', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/author/{author_id}', [AuthorController::class, 'index']);

Route::post('/add-to-cart', [CartController::class, 'addItem'])->name('add.to.cart');
Route::post('/dec-from-cart', [CartController::class, 'decrementItem'])->name('dec.from.cart');
Route::post('/del-from-cart', [CartController::class, 'deleteItem'])->name('del.from.cart');
Route::post('/get-total', [CartController::class, 'getTotal'])->name('get.total');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'makeOrder'])->name('makeOrder');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/admin', [AdministrationController::class, 'index'])->name('admin.index');
Route::post('/admin', [AdministrationController::class, 'auth'])->name('admin.auth');

Route::middleware(CheckAdminPermission::class)->group(function () {
    Route::get('/admin/orders', [AdministrationController::class, 'orders_index'])->name('admin.orders.index');
    Route::put('/admin/orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    Route::get('admin/order/{id}', [OrderController::class, 'index'])->name('admin.order.index');
    Route::post('admin/order/addItem/{id}', [OrderController::class, 'addItem'])->name('admin.orders.addItem');

    Route::get('/admin/products', [AdministrationController::class, 'products_index'])->name('admin.products.index');

    Route::get('/admin/import', [AdministrationController::class, 'import_index'])->name('admin.import.index');
    Route::post('/admin/import', [AdministrationController::class, 'import_process'])->name('admin.import.process');
});

Route::get('/user', [UserController::class, 'index'])->name('user.index');
