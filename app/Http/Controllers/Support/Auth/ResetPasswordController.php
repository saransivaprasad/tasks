<?php

namespace App\Http\Controllers\Support\Auth;

use Auth;
use Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/support/dashboard';

    public function __construct()
    {
        $this->middleware('guest:support');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', [
            'title' => 'Reset Support User Password',
            'passwordUpdateRoute' => 'support.password.update',
            'token' => $token,
        ]);
    }

    protected function broker()
    {
        return Password::broker('supports');
    }

    protected function guard()
    {
        return Auth::guard('support');
    }
}
