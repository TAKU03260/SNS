<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'username' => 'required|string|min:4|max:12',
            'mail' => 'email|required|min:4|max:30|unique:users',
            'password' => 'required|alpha_num|min:4|max:20',
            'password-confirm' => 'required|alpha_num|min:4|max:20|same:password',
        ], [
            'username.required' => '名前は必須です',
            'mail.same' => 'メールアドレスは必須です',
            'password.required' => 'パスワードは必須です',
            'password-confirm.same' => '一致していません',
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    //public function registerForm()
    // {
    //    return view("auth.register");
    // }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $this->validator($data);
            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
    }



    public function added()
    {
        $user = DB::table('users')
            ->latest()
            ->first();
        return view('auth.added', compact('user'));
    }




    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $profile_update
     * @return \Illuminate\Contracts\Validation\Validator
     */
}
