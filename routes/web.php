<?php

use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// Auth::routes(['only'=>'login']);
Route::post('logout', 'Auth\\LoginController@logout')->name('logout');
Route::get('login', 'Auth\\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\\LoginController@login');

Route::redirect('/','welcome');
// Route::redirect('home','dashboard');

Route::get('welcome', function(){return view('welcome');});


Route::middleware(['twofactor'])->group(function(){
    Route::get('otp','TwoFactorController@index')->name('otp.index');
    Route::post('otp','TwoFactorController@verifyPass')->name('otp.verify');
});
Route::middleware(['auth'])->group(function(){
    Route::get('home', function () {
        return view('home');
    });
});
