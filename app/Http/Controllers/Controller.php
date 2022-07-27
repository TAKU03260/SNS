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

        //ページが始まる前に読み込む、会員サイトなど専用のページに行くために途中で割り込ませる。

        $this->middleware(function ($request, $next) {
            $data1 = DB::table('follows')->where('follower', '=', Auth::id())->count();
            //$data1をfollowsテーブルのfollowerカラムとログインユーザーが一致していれば要素の数をカウントして変数定義する。
            //followerがログインユーザーと一致していれば、自分がフォローしている人を把握することが出来るため、人数をカウントできる。
            $data2 = DB::table('follows')->where('follow', '=', Auth::id())->count();
            //上記と同様

            View::share('data1', $data1);
            View::share('data2', $data2);
            //View::shareはどのページにおいても同じ表示をするためのメソッド。

            return $next($request);
        });
    }
}
