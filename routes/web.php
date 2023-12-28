<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ProductController;
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
Route::get('/',[UserController::class,'main_page']);
Route::get('/login',[UserController::class,'login_form']);
Route::post('/process_login',[UserController::class,'login'])->name('process_login');

Route::post('/logout',function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('layouts.master');
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/monitoring',[ProductController::class,'monitoring_product'])->name('monitoring_product');

        Route::group(['prefix' => 'upload'], function(){
            Route::get('/',[ProductController::class,'upload_product'])->name('upload_product');
            Route::post('/preview',[ProductController::class,'upload_preview'])->name('upload_preview');
            Route::post('/process',[ProductController::class,'upload_process'])->name('upload_product');
        });
        
        Route::group(['prefix' => 'edit'], function(){
            Route::get('/',[ProductController::class,'edit_product'])->name('edit_product');
            Route::post('/cart-change',[ProductController::class,'change_product'])->name('change_product');
            Route::post('/cancel-change',[ProductController::class,'cancel_change_product'])->name('cancel_change_product');
            Route::post('/submit-change',[ProductController::class,'submit_change_product'])->name('submit_change_product');
        });
        
    });
});


