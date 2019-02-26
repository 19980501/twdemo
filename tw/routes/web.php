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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/tweet', 'TweetController@store')->name('home');


Route::get('/users', 'UserController@index')->name('user_list');

Route::post('/users/follow/{follow_id}', 'UserController@follow');
//Route::post('/tweet/{$id}', 'TweetController@destroy');
Route::delete('/tweet/destroy/{id}','TweetController@destroy');

Route::get('/chat', 'ChatController@index');


Route::get('ajax/chat', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat', 'Ajax\ChatController@create'); // チャット登録



