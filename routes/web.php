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
Route::get('/user/dashboard', 'Controller@user_dashboard_view');
Route::get('/user/profile/{id}', 'Controller@profile_view');
Route::get('/user/profile/{following_id}/follow', 'Controller@profile_view');
Route::post('/user/profile/{following_id}/follow', 'Controller@following_store');
Route::get('/user/profile/{followed_id}/unfollow', 'Controller@profile_view');
Route::delete('/user/profile/{followed_id}/unfollow', 'Controller@followed_destroy');
Route::get('/user/learnedwordslist/{id}', 'Controller@user_learned_words_list_view');
Route::get('/user/categorieslist', 'Controller@categories_view');
Route::get('/user/lesson/{category_id}', 'Controller@lesson_view');
Route::post('/user/lesson/{category_id}', 'Controller@lesson_check');
Route::get('/user/result/{category_id}', 'Controller@result_view');


Route::get('/logout', 'Auth\LoginController@logout');

route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::get('/admin/categories/{page_number}', 'AdminController@categories_view');
    Route::get('/admin/category/edit/{category_id}', 'AdminController@category_edit_view');
    Route::patch('/admin/category/restore/{category_id}', 'AdminController@category_edit_store');
    Route::get('/admin/category/delete_view/{category_id}', 'AdminController@category_delete_view');
    Route::get('/admin/category/delete/{category_id}', 'AdminController@categories_view');
    Route::delete('/admin/category/delete/{category_id}', 'AdminController@category_delete');
    Route::get('/admin/category/add_word/{category_id}', 'AdminController@category_add_word_view');
    Route::post('/admin/category/add_word/store/{category_id}', 'AdminController@category_add_word_store');
    Route::get('/admin/category/view_word/{category_id}/{page_number}', 'AdminController@category_view_words');
    Route::get('/admin/category/edit_word/{word_id}', 'AdminController@category_edit_word');
    Route::patch('/admin/category/edit_word/store/{word_id}', 'AdminController@category_restore_word');
    Route::get('/admin/category/view_delete_word/{word_id}', 'AdminController@category_view_delete_word');
    Route::delete('/admin/category/delete_word/{word_id}', 'AdminController@category_delete_word');
    Route::get('/admin/users/{page_number}', 'AdminController@view_all_users');
    Route::get('/admin/user/add', 'AdminController@add_user');
    Route::post('/admin/user/store', 'AdminController@store_user');
    Route::get('/admin/user/edit/{id}', 'AdminController@view_edit_user');
    Route::patch('/admin/user/restore/{id}', 'AdminController@restore_user');
    Route::get('/admin/user/view_delete/{id}', 'AdminController@view_destroy_user');
    Route::delete('/admin/user/delete/{id}', 'AdminController@destroy_user');
});


