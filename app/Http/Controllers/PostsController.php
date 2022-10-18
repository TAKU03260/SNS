<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;




class PostsController extends Controller
{

    public function index(Request $request)
    {
        $follow_id = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');
        //followsテーブルのfollowerカラムとログインユーザーが一致するとき、$folloW_idとして変数定義する。つまり自分がフォローしている人の一覧。
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            //postsテーブルのuser_idとusersテーブルのidを統合する。

            ->where('user_id', Auth::id())
            //ログインユーザーとuser_idが一致するモノ
            ->orWhereIn('users.id', $follow_id)
            //もしくはuserテーブルのidとfollow_idが一致する複数のモノ
            ->select('users.username', 'users.images', 'users.id', 'posts.*')
            //上記のモノを持ってくる。
            ->orderBy('posts.created_at', 'desc')
            //postsテーブルのcerated_atが新しい順(desc)で並べる<>asc
            ->get();

        $user = Auth::user();
        //ログインユーザーを$userと定義

        $request->validate(
            [
                'upPost' => ['min:10', 'max:300'],

            ],
            [
                'upPost.min' => '10文字以上でお願いします。'
            ]
        );


        return view('posts.index', compact('posts', 'user'));
        //compact関数：変数名とその値から配列を決める。

    }

    //ユーザー登録完了画面
    public function added()
    {
        return view('auth.added');
    }



    //投稿内容の作成メソッド

    public function create(Request $request)
    {
        $post = $request->input('newPost');
        //name属性'newPost'に入力されたものを$postして変数定義する。
        DB::table('posts')->insert([
            'posts' => $post,
            //name属性'newPost'に入力されたものをpostsカラムに入れる
            'user_id' => Auth::id(),
            //user_idに現在ログインしているユーザーを入れる
            'created_at' => now(),
            'updated_at' => now(),
            //制作日時と更新日時には現在の時刻を入れる

            //insertでPostsテーブルに要素入れていく。
        ]);

        return redirect('/top');
    }

    //投稿内容の更新メソッド
    public function update(Request $request)
    {
        $id = $request->input('id');
        //選択されたidを$idとして定義する。
        $up_post = $request->input('upPost');
        //upPostのname属性のものに入力されたものを$up_postとして定義する.
        DB::table('posts')
            ->where('id', $id)
            ->update(
                [
                    'posts' => $up_post,
                    'updated_at' => now(),
                    //上記と同じ仕組み
                ]
            );

        return redirect('/top');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        //選択したidが一致するものを削除

        return redirect('/top');
    }


    public function test(Request $request)
    {
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.user_id', Auth::id())
            ->select('users.username', 'users.images', 'users.id', 'posts.*')
            ->orderBy('posts.created_at', 'desc')
            ->get();
        return view('posts.test', compact('posts'));
    }
}
