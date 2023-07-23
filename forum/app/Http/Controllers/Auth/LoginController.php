<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;



class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = 'verification.notice';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
     
        $remember = $request->has('remember') ? true : false; 
     
     
        if (Auth::attempt($request->only(['email', 'password']), $remember))
        {
            // $request->session()->regenerate();
            return redirect()->intended('/');

        }
        else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
                'pasword' => 'The password is incorrect. Try again.'
            ]);
        }
            
    }

    protected function sendLoginResponse(Request $request)
    {
        $rememberTokenExpireMinutes = 60;
        $rememberTokenName = Auth::getRecallerName();

        Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), $rememberTokenExpireMinutes);
 
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
 
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
