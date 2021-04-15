<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function attempLogin(Request $request)
    {
        Mail::send(new Mailable());
    }
}
