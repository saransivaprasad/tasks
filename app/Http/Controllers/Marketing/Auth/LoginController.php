<?php

namespace App\Http\Controllers\Marketing\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use ThrottlesLogins;

    public function username()
    {
        return 'email';
    }

    public function __construct()
    {
        $this->middleware('guest:marketing')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Marketing User Login',
            'loginRoute' => 'marketing.login',
            'forgotPasswordRoute' => 'marketing.password.request',
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::guard('marketing')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            //Authentication passed...
            return redirect()
                ->intended(route('marketing.home'))
                ->with('status', 'You are Logged in as Marketing User!');
        }

        $this->incrementLoginAttempts($request);

        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('marketing')->logout();
        return redirect()
            ->route('marketing.login')
            ->with('status', 'Marketing User has been logged out!');
    }

    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email|exists:marketings|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];
        $request->validate($rules, $messages);
    }

    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');
    }
}
