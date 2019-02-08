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
    Route::get('/', function () {
        return view('/user/dashboad');
    });
});
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/dashboard', 'Controller@user_dashboard_view');
Route::get('/user/learnedwordslist/{id}', 'Controller@user_learned_words_list_view');
Route::get('/logout', 'Auth\LoginController@logout');
