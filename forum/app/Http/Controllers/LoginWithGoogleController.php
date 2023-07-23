<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
// use Laravel\Socialite\Contracts\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->redirect();
        return Socialite::driver('google')
                ->with(['prompt' => 'select_account'])
                ->redirect();

    }

    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user();
    
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make($user->name.'@'.$user->id),
                ]);
      
                Auth::login($newUser);
      
                return redirect()->route('/');
            }
            // dd($user);
      
        } 
        catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
