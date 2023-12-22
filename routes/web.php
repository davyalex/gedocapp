<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;

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


Route::controller(AuthController::class)->group(function(){
    Route::get('/register','register')->name('register-form');
    Route::post('/register','register')->name('register');

    Route::get('/login','login')->name('login-form');
    Route::post('/login','login')->name('login');
    Route::get('/logout','logout')->name('logout');



});

route::middleware('auth')->group(function(){

    Route::controller(HomeController::class)->group(function(){
        Route::get('/','home')->name('home');
        Route::get('/document','getDocumentOfCategory');
    
    });
    
    Route::controller(DocumentController::class)->group(function(){
        Route::get('document/index','index')->name('document.index');
        Route::post('document/store','store')->name('document.store');
        Route::get('document/download','downloadFile')->name('document.download');
        // Route::get('document/edit/{id}','edit')->name('document.edit');
        Route::post('document/update/{id}','update')->name('document.update');
        Route::post('document/destroy/{id}','destroy')->name('document.destroy');

        Route::get('document/nb_download/{id}','incrementNbDownload');

    });
});

