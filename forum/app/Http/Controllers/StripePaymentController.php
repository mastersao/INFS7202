<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function show()
    {
        return view('stripe');
    }

    public function checkout(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from laravel-forum." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return redirect('dashboard');
    }

    // public function success()
    // {
    //     return view('dashboard');
    // }
}
