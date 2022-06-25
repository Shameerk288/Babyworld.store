<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\RatingController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\UserController;
use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop/category', [HomeController::class, 'categories']);
Route::get('/shop/category/{slug}', [HomeController::class, 'cat_products']);
Route::get('/shop/{prod_slug}', [HomeController::class, 'prod_details']);

Route::get('/product-list',[HomeController::class,'productsearchlist']);
Route::post('/searchproduct',[HomeController::class,'searchproduct']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/shop', [HomeController::class, 'allproducts']);

Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::put('/add-to-cart', [CartController::class, 'store']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    Route::post('/update-cart', [CartController::class, 'update']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/create-order', [CheckoutController::class, 'store']);

    Route::get('/my-orders', [UserController::class, 'index']);
    Route::get('/order-details/{id}', [UserController::class, 'show']);

    Route::post('/add-rating', [RatingController::class, 'store']);

    Route::get('add-review/{slug}/user-review', [ReviewController::class, 'create']);
    Route::post('add-review', [ReviewController::class, 'store']);
    Route::get('edit-review/{slug}/user-review', [ReviewController::class, 'edit']);
    Route::put('update-review', [ReviewController::class, 'update']);
});


Route::group(['middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    });

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/add-category', [CategoryController::class, 'create']);
    Route::post('/insert-category', [CategoryController::class, 'store']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('/update-category/{id}', [CategoryController::class, 'update']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/add-product', [ProductController::class, 'create']);
    Route::post('/insert-product', [ProductController::class, 'store']);
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::put('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('admin/order-details/{id}', [OrderController::class, 'show']);
    Route::patch('update-order/{id}', [OrderController::class, 'update']);
    Route::get('orders-history', [OrderController::class, 'ordersHistory']);

    Route::get('/users', [CustomerController::class, 'index']);
    Route::get('/user-details/{id}', [CustomerController::class, 'show']);
});
