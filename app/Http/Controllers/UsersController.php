<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

class UsersController extends Controller
{
    //
    public function profile()
    {

        $user = Auth::user();
        return view('users.profile', compact('user'));
        //profileメソッドを経由するとき、usersファイルのprofile.bladeを開く設定。

    }



    public function update(Request $request)
    {
        $auth_mail = Auth::user()->mail;

        $request->validate(
            [
                'username' => ['required', 'string', 'min:4', 'max:12'],

                'mail' => ['email', 'required', 'min:4', 'max:30', Rule::unique('users', 'mail')->ignore($auth_mail, 'mail')],

                //Rule::unique('users','mail')はusersテーブルのmailカラムに登録をあるものは除外する。ignore($auth_mail,'mail')は取得した変数を除く。＞ログインしているユーザーは除くということ。


                'newpassword' => ['alpha_num', 'min:4', 'max:12'],

                'bio' => ['max:100'],

                'images' => ['file', 'image', 'mimes:jpg,png,bmp,gif,svg'],
            ],
            [
                'username.required' => '名前は必須です',

                'mail.required' => 'メールアドレスは必須です',
                'mail.min' => '4文字以上でお願いします',
                'mail.max' => '12文字以下でお願いします',


                'newpassword.min' => '4文字以上でお願いします。',

                'bio.max' => '200文字まで入力可能です',
                // 'image.image' => '指定のファイル以外不可です',
            ]
        );



        $id = Auth::id();




        if (request('bio')) {
            $bio = $request->input('bio');
        } else {
            $bio = DB::table('users')
                ->where('id', Auth::id())
                ->value('bio');
        }


        $username = $request->input('username');



        if (request('password')) {
            $newpassword = Hash::make($request->input('password'));
        } else {
            $newpassword = DB::table('users')
                ->where('id', Auth::id())
                ->value('password');
        }



        if (request('mail')) {
            $mail = $request->input('mail');
        } else {
            $mail = DB::table('users')
                ->where('id', Auth::id())
                ->value('mail');
        }

        $mail = $request->input('mail');



        if (request('images')) {
            $images = $request->file('images')->getClientOriginalName();
            $request->file('images')->storeAs('public/images', $images);
        } else {
            $images = DB::table('users')
                ->where('id', Auth::id())
                ->value('images');
        }

        DB::table('users')
            ->where('id', $id)
            ->update(
                [
                    'bio' => $bio,
                    'username' => $username,
                    'password' => $newpassword,
                    'mail' => $mail,
                    'images' => $images,
                ]

            );

        return redirect('profile');
    }


    //userテーブルにユーザー登録があるものを出すための機能
    public function search(Request $request)
    {
        $users = DB::table('users')
            ->where('id', '<>', Auth::id())
            ->get();
        //usersテーブルのidがログインしている以外のidを取得し、$usersという変数に入れる。'<>'は不等式：一致しないときを示す。

        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();
        //followsテーブルのfollowerカラムとログインしているユーザーが同じとき、情報を取得し$followingsの変数に入れる。自分がフォロワーにいるということはfollowカラムの人をフォローしていることになる。

        $keyword = $request->input('search');
        //name属性にsearchのformに文字が入力されたとき、情報を取得し、$keyword変数に入れる。


        if (isset($keyword)) {
            $users = DB::table('users')
                ->where('id', '<>', Auth::id())
                ->where('username', 'like', "%$keyword%")
                ->get();

            //isset関数は存在があるか調べるための機能->whereでusernameが一部一致していれば取得する。

        }


        return view('users.search', compact('users', 'followings', 'keyword'));
    }
}
