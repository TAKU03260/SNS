<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index()
    {
        return view('posts.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function added()
    {
        return view('auth.added');
    }
}
