<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Email;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }
}
