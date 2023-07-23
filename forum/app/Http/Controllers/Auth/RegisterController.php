<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Mail\SignupMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;
use Session;

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
    protected $redirectTo = '/email/verify';


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

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
            'name' => ['required', 'string', 'min:5', 'max:64'],
            'email' => ['required', 'string', 'email', 'max:128', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['nullable', 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'],
            // 'phone_number' => ['sometimes'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'avatar' => ['sometimes', 'image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                
                if (!$response->success) {
                    Session::flash('g-recaptcha-response', 'please check g-recaptcha');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute.'google recaptcha failed');
                }
            },
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        if (request()->has('avatar')) {
            $avatarUpload = request()->file('avatar');
            $avatarName = time() . '.' . $avatarUpload->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatarUpload->move($avatarPath, $avatarName);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' =>  $data['phone_number'],
                'password' => Hash::make($data['password']),
                'avatar' => '/images/' . $avatarName,
            ]);
            // $user->sendEmailVerificationNotification();
            Mail::to($user->email)->send(new SignupMail($data));
            
            return $user;
        }
        else{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' =>  $data['phone_number'],
                'password' => Hash::make($data['password']),
                // 'avatar' => '/images/' . 'avatar.jpg',
            ]);
            return $user;
        }
    }

}
