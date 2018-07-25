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

Route::get('/', 'MemberController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/edit', 'HomeController@edit')->name('home/edit');
Route::post('/home/edit', 'HomeController@update');
Route::post('/home/edit/profile_image', 'HomeController@updateProfileImage')->name('home/edit/profile_image');
Route::post('/home/tag', 'HomeController@addTag')->name('home/addTag');
Route::delete('/home/tag', 'HomeController@removeTag')->name('home/removeTag');

Route::get('/friend/edit', 'FriendController@edit')->name('friend/edit');
Route::post('/friend/delete', 'FriendController@delete');
Route::post('/friend/add', 'FriendController@create');

// tags
Route::post('/member/tag', 'TagController@add')->name('tag/add');
Route::delete('/member/tag', 'TagController@remove')->name('tag/remove');

Route::get('/member/{id}', 'MemberController@show')->where('id', '[0-9]+')->name('member/home');
Route::get('/member/interest/{id}', 'MemberController@interest');
Route::post('/member/interest/', 'MemberController@create');
