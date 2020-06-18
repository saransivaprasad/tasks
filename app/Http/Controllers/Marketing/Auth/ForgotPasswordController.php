<?php

namespace App\Http\Controllers\Marketing\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:marketing');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email', [
            'title' => 'Marketing User Password Reset',
            'passwordEmailRoute' => 'marketing.password.email'
        ]);
    }

    public function broker()
    {
        return Password::broker('marketings');
    }

    public function guard()
    {
        return Auth::guard('marketing');
    }
}
