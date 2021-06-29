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

//ブログ一覧へ
Route::get('/', 'BlogController@showList')->name('blogs');
//ブログ登録
Route::get('/blog/create', 'BlogController@showCreate')->name('create');
//ブログ投稿画面
Route::post('/blog/store', 'BlogController@exeStore')->name('store');
//ブログ詳細画面を表示
Route::get('/blog/{id}', 'BlogController@showDetail')->name('show');
//ブログ編集
Route::get('/blog/edit/{id}', 'BlogController@showEdit')->name('edit');
//ブログ編集投稿画面
Route::post('/blog/update', 'BlogController@exeUpdate')->name('update');
//ブログ削除
Route::post('/blog/delete/{id}', 'BlogController@exeDelete')->name('delete');