<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContentsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\SegurosController;
use App\Http\Middleware\Admin;

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
Route::view("/login",'theme.auth.login')->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'login'])->name('login-post')->middleware('guest');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::middleware([Admin::class])->group(function () {
    Route::get('',[AdminController::class,'home'])->name('home-admin');
    Route::any('contents/updateOrder',[ContentsController::class,'updateOrder'])->name('contents.updateOrder');
    Route::resource('contents', ContentsController::class);
    Route::post('category/updateOrder',[CategoryController::class,'updateOrder'])->name('category.updateOrder');
    Route::resource('category', CategoryController::class);
    Route::post('campus/updateOrder',[CampusController::class,'updateOrder'])->name('campus.updateOrder');
    Route::resource('campus', CampusController::class);
    Route::get('product/edicionmasiva',[ ProductController::class,'edicionMasiva'])->name('product.edicionmasiva');
    Route::post('product/setfield',[ ProductController::class,'setField'])->name('product.setfield');
    Route::resource('product', ProductController::class);

    Route::resource('users', UsersController::class);

    Route::post('banner/updateOrder',[BannerController::class,'updateOrder'])->name('banner.updateOrder');
    Route::resource('banner', BannerController::class);
    
    Route::get('ventas', [SalesController::class,'index'])->name('sales.index');

});


Route::any('/{any}', function () {
    return redirect('/');
})->where('any', '.*');