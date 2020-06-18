<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', [
            'title' => 'Reset Admin Password',
            'passwordUpdateRoute' => 'admin.password.update',
            'token' => $token,
        ]);
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
