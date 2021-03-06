<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/perfil';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function showRegistrationForm()
    {
        $userinfo=false;
        return view('auth.register', ['userinfo'=>$userinfo]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['avatar']) {
            $user = User::create([
            'name' => ucwords($data['name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'dob' => $data['dob'],
            'tel' => $data['tel'],
            'genero' => $data['genero'],
            'avatar' => $data['avatar'],
            'rt'=>100,
        ]);
        }
        else{
            $user = User::create([
            'name' => ucwords($data['name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'dob' => $data['dob'],
            'tel' => $data['tel'],
            'genero' => $data['genero'],
            'rt'=>100,
            ]);
        }
        
        if ($data['service_id']) {
            $user->socialProvider()->create([
                'provider_id' => $data['service_id'],
                'provider' => 'facebook'
            ]);
        }
        Session::flash('inicio', 'true');
        
        return $user;
        
    }
}
