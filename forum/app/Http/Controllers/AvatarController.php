<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AvatarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function updateAvatar(Request $request) 
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,bmp,svg,png|max:5000'
        ]);

        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('/images/'), $avatarName);
  
        Auth()->user()->update(['avatar' => '/images/' . $avatarName,]);
  
        return redirect()->route('dashboard')->with('success', 'Avatar updated successfully.');
    }

    protected function showUpdateForm()
    {
        return view('update-avatar');
    }

    protected function show()
    {

        $user = Auth::user();
        return view('update-details', ['user' => $user]);
    }

    protected function updateDetails(Request $request) 
    {
        $request->validate([
            'username' => 'required|min:5'
        ]);

        $user = Auth::user();
        $user->name = $request->username;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Username updated successfully.');
    }

    public function messages(): array
    {
        return [
            'username.required' => 'A name is required',
        ];
    }
}
