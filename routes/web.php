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
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Support\Facades\Auth;

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');


Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top', 'PostsController@index');





Route::get('/profile', 'UsersController@profile');

Route::get('/search', 'UsersController@search');
Route::post('/search', 'UsersController@search');


//フォロー・フォロワーリンク

Route::get('/followList', 'FollowsController@followList');
Route::get('/followerList', 'FollowsController@followerList');



Route::get('/follow_profile', 'FollowsController@follow_profile');
Route::get('/follower_profile', 'FollowsController@follower_profile');




//フォロー・フォロワー数
Route::get('/count_follow', 'FollowsController@count_follow');
Route::get('/count_follower', 'FollowsController@count_follower');






//フォローしている人のプロフィール画面

Route::get('/follow_profile', 'FollowsController@follow_profile');
Route::get('/{id}/follow_profile', 'FollowsController@follow_profile');

Route::get('/follower_profile', 'FollowsController@follower_profile');
Route::get('/{id}/follower_profile', 'FollowsController@follower_profile');


//ログアウト変移
Route::get('/logout', 'Auth\LoginController@logout');

//投稿機能

Route::post('post/create', 'PostsController@create');

//更新
Route::get('/post/{id}/updateForm', 'PostsController@updateForm');
Route::post('/post/update', 'PostsController@update');


//削除

Route::get('/post/{id}/delete', 'PostsController@delete');


//検索機能

//フォロー機能
Route::post('/follow/create', 'FollowsController@create');
Route::post('/follow/delete', 'FollowsController@delete');
