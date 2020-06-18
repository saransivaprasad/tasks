<?php

namespace App\Http\Controllers\Support\Auth;

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
        $this->middleware('guest:support');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email', [
            'title' => 'Support User Password Reset',
            'passwordEmailRoute' => 'support.password.email'
        ]);
    }

    public function broker()
    {
        return Password::broker('supports');
    }

    public function guard()
    {
        return Auth::guard('support');
    }
}
