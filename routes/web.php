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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\UsersController;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Support\Facades\Auth;

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');


Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');





//ログイン中のページ
Route::get('/top', 'PostsController@index');

//postコントローラーの中のindexメソッドはurlが/topの時に実行される

//基本的な機能
//投稿機能➀

Route::post('post/create', 'PostsController@create');

//更新➁
Route::get('/post/{id}/updateForm', 'PostsController@updateForm');
Route::post('/post/update', 'PostsController@update');

//削除➂

Route::get('/post/{id}/delete', 'PostsController@delete');



//フォロー・フォロワーの関する機能


//フォロー・フォロワーの一覧表示➀
Route::get('/followList', 'FollowsController@followList');
Route::get('/followerList', 'FollowsController@followerList');

//フォロー・フォロワー一覧の表示から個人のプロフィールに行くための機能➁

//follow
Route::get('/follow_profile', 'FollowsController@follow_profile');
Route::get('/{id}/follow_profile', 'FollowsController@follow_profile');
//follower
Route::get('/follower_profile', 'FollowsController@follower_profile');
Route::get('/{id}/follower_profile', 'FollowsController@follower_profile');

//フォローを外す・付ける機能➂
Route::post('/follow/create', 'FollowsController@create');
Route::post('/follow/delete', 'FollowsController@delete');



//ログインユーザーのプロフィールを編集する機能
Route::get('/profile', 'UsersController@profile');

//プロフィールの更新機能➀

Route::post('/profile/update', 'UsersController@update');



//ユーザーを検索するための機能
Route::get('/search', 'UsersController@search');
Route::post('/search', 'UsersController@search');
//post通信のため必要



//ログアウト変移
Route::get('/logout', 'Auth\LoginController@logout');
