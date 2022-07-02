<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $data1 = DB::table('follows')->where('follows.follower', '=', Auth::id())->count();

            $data2 = DB::table('follows')->where('follows.follow', '=', Auth::id())->count();
            View::share('data1', $data1);
            View::share('data2', $data2);

            return $next($request);
        });
    }
}
