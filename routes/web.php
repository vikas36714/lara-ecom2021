<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'cache cleared!!';
});

// Route::view('/admin', 'admin.dashboard.index');
// Route::view('/admin/login', 'admin.auth.login');

Route::view('/', 'site.pages.homepage');

Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');


require 'admin.php';


