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
    Route::get('/dashboard', 'UserController@dashboardView');
    Route::get('/profile/{id}', 'UserController@profileView');
    Route::get('/profile/{id}/learnedwords', 'UserController@profileLearnedWordsView');
    Route::get('/profile/{id}/learnedlessons', 'UserController@profileLearnedLessonsView');
    Route::post('/relationship/follow', 'UserController@userFollow');
    Route::delete('/relationship/unfollow', 'UserController@userUnfollow');
    Route::get('/categories/{pageNumber}', 'UserController@categoriesView');
    Route::get('/category/{categoryId}', 'UserController@lessonView');
    Route::post('/answer/{wordId}', 'UserController@answerCheck');
});

Route::group(['middleware' => ['can:admin']], function () {
    Route::get('/admin/categories/{pageNumber}', 'AdminController@categoriesView')->name('admin');
    Route::get('/admin/category/{categoryId}/edit', 'AdminController@categoryEdit')->name('edit');
    Route::patch('/admin/category/{categoryId}/restore', 'AdminController@categoryRestore')->name('edit');
    Route::get('/admin/category/{categoryId}/destroy', 'AdminController@categoryDestroy')->name('destroy');
    Route::delete('/admin/category/{categoryId}/delete', 'AdminController@categoryDelete')->name('delete');
});

Route::get('/logout', 'Auth\LoginController@logout');
