<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OTPController extends Controller
{

    public function showVerifyForm()
    {
        return view('form-Verify');
    }

    public function verify(Request $request)
    {
     
        $otp = intval($request->otp);
        if ($otp === Cache::get('OTP')) {
            auth()->user()->update(['isVerified' => true]);
            return redirect(route('dashboard'), 201);
        }


    }
}
