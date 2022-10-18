<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowsController extends Controller
{
    //

    public function followList(Request $request)
    {

        $user = Auth::user();
        //$userをログインユーザーとして定義する。


        $follow_id = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');
        //followsテーブル内のfollowerとログインユーザーが一致したものを、followに入っているデータををfollow_idとして定義する。followカラムを持ってくる。



        $follow_users = DB::table('users')
            ->whereIn('id', $follow_id)
            ->get();
        //userテーブルのidがfollow_idと一致するものをfollow_usersとして定義する。whereINは複数存在するときに使う。

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            //postsテーブルのuser_idとusersテーブルのidを統合する。

            ->WhereIn('users.id', $follow_id)
            //もしくはuser_idとfollow_idが一致する複数のモノ
            ->select('users.username', 'users.images', 'posts.*', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            //postsテーブルのcerated_atを新しい順(desc)で並べる。逆はasc
            ->get();




        return view('follows.followList', compact('user', 'follow_users', 'posts'));
        //compact関数はデータの受け渡し方を定義する
    }

    //以下はfollowListと同じ

    public function followerList()

    {
        $user = Auth::user();

        $follower_id = DB::table('follows')
            ->where('follow', Auth::id())
            ->pluck('follower');

        $follower_users = DB::table('users')
            ->whereIn('id', $follower_id)
            ->get();


        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            //postsテーブルのuser_idとusersテーブルのidを統合したものを$posts変数と定義。


            ->WhereIn('users.id', $follower_id)
            //もしくはuser_idとfollow_idが一致する複数のモノ
            ->select('users.username', 'users.images', 'posts.*', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            //postsテーブルのcerated_atを新しい順(desc)で並べる<>asc
            ->get();


        return view('follows.followerList', compact('user', 'follower_users', 'posts'));
    }





    //フォローする機能
    public function create(Request $request)
    {

        DB::table('follows')
            ->insert([
                'follow' => $request->input('id'),
                //followにrequestで取ってきたidを入れる。
                'follower' => Auth::id(),
                //followerに自分のidを入れる。
            ]);

        //followsテーブルに、カラムを挿入する。

        return back();
        //同じページにリダイレクトする。
    }



    //フォロー外す機能
    public function delete(Request $request)
    {
        DB::table('follows')
            ->where([
                'follow' => $request->input('id'),
                'follower' => Auth::id(),
            ])
            ->delete();
        //仕組み自体は上記と同じだがidをwhereで探し出し、delete()で削除する
        return back();
    }


    //フォローしている人のprofileを表示するための機能
    public function follow_profile($id)
    {


        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        //usersテーブルのidと選択したidと同じとき、user変数として定義。

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            //userテーブルのidとpostsテーブルのuser_idを繋げる。
            ->where('user_id', $id)
            //user_idと選択したidが一致するとき。
            ->select('users.id', 'username', 'user_id', 'users.images', 'posts', 'posts.created_at as created_at')
            //何をテーブルから持ってくるのかを定義する。
            ->orderBy('posts.created_at', 'desc')
            //postsテーブルのcreated_atが新しい順に取り出す。
            ->get();

        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();

        //followsテーブルのfollowerカラムとログインユーザーが一致するものをfollowingsと定義。
        return view('users.follow_profile', compact('user', 'posts', 'followings'));
    }



    //上記のfollow_profileと同じ記述
    public function follower_profile($id)

    {

        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        //usersテーブルのidと選択したidと同じときuser変数として定義。

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            //userテーブルのidとpostsテーブルのuser_idを繋げる。
            ->where('user_id', $id)
            ->select('users.id', 'username', 'user_id', 'users.images', 'posts', 'posts.created_at as created_at')
            //何をテーブルから持ってくるのかを定義する。
            ->orderBy('posts.created_at', 'desc')
            //'posts'→tableを定義しているのでどこのtableかはしていしているので必要無し。
            ->get();

        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();


        return view('users.follower_profile', compact('user', 'posts', 'followings'));
    }
}
