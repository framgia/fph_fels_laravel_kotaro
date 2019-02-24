<?php

use App\Http\Controllers\UserController;

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


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard/{id}', 'UserController@dashboardView');
    Route::get('/profile/learnedwords/{id}', 'UserController@profileLearnedWordsView');
    Route::get('/profile/learnedlessons/{id}', 'UserController@profileLearnedLessonsView');
    Route::get('/profile/activities/{id}', 'UserController@profileActivitiesView');
});

Route::get('/logout', 'Auth\LoginController@logout');
