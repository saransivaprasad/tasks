<?php

namespace App\Http\Controllers\Marketing\Auth;

use Auth;
use Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/marketing/dashboard';

    public function __construct()
    {
        $this->middleware('guest:marketing');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', [
            'title' => 'Reset Marketing User Password',
            'passwordUpdateRoute' => 'marketing.password.update',
            'token' => $token,
        ]);
    }

    protected function broker()
    {
        return Password::broker('marketings');
    }

    protected function guard()
    {
        return Auth::guard('marketing');
    }
}
