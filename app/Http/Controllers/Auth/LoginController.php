<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Socialite;
use Illuminate\Http\Request;
use App\User;
use App\SocialProvider;
use Cart;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/acceso';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ["Los datos no coinciden."],
        ]);
    }
   
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 
        ])->scopes([
            'email', 'publish_actions'
        ])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try{
            $userinfo = Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email'
        ])->user();
        }catch(\Exception $e){
            return redirect('/entrar');
        }

        $socialProvider = SocialProvider::where('provider_id', $userinfo->getID())->first();

        if(!$socialProvider){
            /*$user= User::firstOrCreate(
                ['name'=>$userinfo->getName()],
                ['email'=>$userinfo->getEmail()]             
            );

            $user->socialProvider()->create([
                'provider_id' => $userinfo->getId(),
                'provider' => 'facebook'
            ]);
            return redirect('/registro');*/
         
            return view('auth.register', ['userinfo'=>$userinfo]);
           
        }
        else{
            $user = $socialProvider->user;

            auth()->login($user);

            if (Cart::content()->count()>0){
              return redirect()->intended(url('carrito'))->withInput();
            }
            else {
              return redirect()->intended(url('/perfil'))->withInput();
            }
        }
    }
}
