<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowsController extends Controller
{
    //

    public function followList()
    {

        $user = Auth::user();
        $follow_id = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');

        $follow_users = DB::table('users')
            ->whereIn('id', $follow_id)
            ->get();

        return view('follows.followList', compact('user', 'follow_users'));
    }



    public function followerList()

    {
        $user = Auth::user();
        $follower_id = DB::table('follows')
            ->where('follow', Auth::id())
            ->pluck('follower');

        $follower_users = DB::table('users')
            ->whereIn('id', $follower_id)
            ->get();

        return view('follows.followerList', compact('user', 'follower_users'));
    }


    public function create(Request $request)
    {

        DB::table('follows')

            ->insert([
                'follow' => $request->input('id'),
                'follower' => Auth::id(),
            ]);

        return back();
    }

    public function delete(Request $request)
    {
        DB::table('follows')
            ->where([
                'follow' => $request->input('id'),
                'follower' => Auth::id(),
            ])
            ->delete();

        return back();
    }

    public function count_follow(Request $request)
    {
        $data1 = DB::table('follows')
            ->where('follows.follow', '=', Auth::id())->count();


        return view('layouts.login', compact('data1'));
    }

    public function count_follower(Request $request)
    {
        $data2 = DB::table('follows')
            ->where('follows.follows', '=', Auth::id())->count();

        return view('layouts.login', compact('data2'));
    }

    public function follow_profile($id)
    {

        $user = DB::table('users')
            ->where('users.id', $id)
            ->first();


        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('user_id', $id)
            ->select('users.*', 'user_id', 'posts', 'posts.created_at as created_at')
            ->orderBy('posts.created_at', 'desc')
            //'posts'→tableを定義しているのでどこのtableかはしていしているので必要無し。
            ->get();

        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();

        return view('users.follow_profile', compact('user', 'posts', 'followings'));
    }

    public function follower_profile($id)


    {

        $user = DB::table('users')
            ->where('users.id', $id)
            ->first();


        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('user_id', $id)
            ->select('users.*', 'user_id', 'posts', 'posts.created_at as created_at')
            ->get();

        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();

        return view('users.follower_profile', compact('user', 'posts', 'followings'));
    }
}
