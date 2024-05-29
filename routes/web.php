<?php

use App\Http\Controllers\admin\BannerCtrl;
use App\Http\Controllers\admin\CategoriesCtrl;
use App\Http\Controllers\admin\donHangCtrl;
use App\Http\Controllers\admin\ProductsCtrl;
use App\Http\Controllers\admin\SaleCtrl;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\paymentCtrl;
use App\Http\Controllers\client\showCateCtrl;
use App\Http\Controllers\ProfileController;
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
//Route Client
Route::get('/', [showCateCtrl::class, 'showSP'])->name('client.trangchu');
Route::get('/detail/{id}', [showCateCtrl::class, 'detail'])->name('client.detail');
Route::get('/tat-ca-san-pham', [showCateCtrl::class, 'showAll'])->name('client.allproduct');
Route::get('danh-muc/{id}/tat-ca-san-pham', [showCateCtrl::class, 'showSpCate'])->name('client.allProductCate');

//Route Giỏ hàng
Route::get('view-cart/{idUser}',[CartController::class, 'showCart'])->name('view.cart');
Route::post('add-cart', [CartController::class, 'addCart'])->name('cart');
Route::get('destroy-cart/{id}', [CartController::class, 'destroyCart'])->name('destroy.cart');

//Thanh toan
Route::post('/thanh-toan', [paymentCtrl::class, 'payment'])->name('payment');
// Route::post('/thanh-toan-online', [paymentCtrl::class, 'payment'])->name('payment');
Route::post('create-vnpay',[paymentCtrl::class, 'create_vnpay'])->name('create.vnpay');
Route::match(['GET','POST'],'return',[paymentCtrl::class, 'return'])->name('return.vnpay');

//Route User
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {


        Route::get('admin/dashboard', function () {
            return view('template.admin');
        });

        Route::resource('category', CategoriesCtrl::class);
        Route::match(['GET', 'POST'], 'edit/{category}', [CategoriesCtrl::class, 'edit'])->name('cate.edit');
        Route::match(['GET', 'POST'], 'destroy/{id}', [CategoriesCtrl::class, 'delete'])->name('cate.destroy');


        Route::resource('sale', SaleCtrl::class);
        Route::get('delete-sale/{id}', [SaleCtrl::class, 'destroy'])->name('sale.delete');

        Route::resource('banner', BannerCtrl::class);
        Route::get('delete-banner/{id}', [BannerCtrl::class, 'destroy'])->name('banner.delete');

        Route::resource('product', ProductsCtrl::class);
        Route::get('delete-product/{id}', [ProductsCtrl::class, 'destroy'])->name('product.delete');

        Route::get('/don-hang',[donHangCtrl::class, 'index'])->name('donhang');
        Route::get('/invoice/{id}',[donHangCtrl::class, 'download'])->name('download');
        // Route::get('/hoadon', function () {
        //     return view('admin.hoadon.invoice');
        // });
    });
    require __DIR__ . '/auth.php';



































// Route::get('client/product', function () {
//     return view('client.product');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');