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

Route::get('/friend/edit', 'FriendController@edit')->name('friend/edit');
Route::post('/friend/edit', 'FriendController@update');

Route::get('/member/{id}', 'MemberController@show')->name('member/home');