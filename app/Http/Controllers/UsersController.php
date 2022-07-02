<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile');
    }



    public function search(Request $request)
    {
        $users = DB::table('users')
            ->where('id', '<>', Auth::id())
            ->get();
        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();
        $keyword = $request->input('search');
        if (isset($keyword)) {
            $users = DB::table('users')
                ->where('id', '<>', Auth::id())
                ->where('username', 'like', "%$keyword%")
                ->get();
        }


        return view('users.search', compact('users', 'followings'));
    }
}
