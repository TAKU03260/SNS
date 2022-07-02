<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PostsController extends Controller
{
    //
    public function index()
    {
        $follow_id = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('user_id', Auth::id())
            ->orWhereIn('users.id', $follow_id)
            ->select('users.username', 'users.images', 'users.id', 'posts.*')
            ->orderBy('posts.created_at', 'desc')
            ->get();
        $user = Auth::user();







        return view('posts.index', compact('posts', 'user'));
    }


    public function added()
    {
        return view('auth.added');
    }



    public function create(Request $request)
    {
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/top');
    }

    //更新用ボタン


    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view(
            'posts.updateForm',
            compact('post')
        );
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                [
                    'posts' => $up_post,
                    'updated_at' => now(),
                ]
            );

        return redirect('/top');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }
}
