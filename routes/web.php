<?php

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/dashboard', function () {
        return view('/user/dashboard');
    });
});
Route::get('/', function () {
    if (Auth::check()) {
        header('Location: /user/dashboard');
    }

    return view('welcome');
});

Auth::routes();

<<<<<<< HEAD
Route::get('/home', 'HomeController@index')->name('home');
=======
Route::get('/user/dashboard', 'Controller@user_dashboard_view');
Route::get('/logout', 'Auth\LoginController@logout');
>>>>>>> 22e2e05154c3c7a556aa65c18930005eef9ef407
