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
    public function search()
    {
        $users = DB::table('users')->get();

            ->select('username')
            ->where('username like "%".$users."%"');
            ->get();


        return view('users.search', compact('users'));
    }
}
