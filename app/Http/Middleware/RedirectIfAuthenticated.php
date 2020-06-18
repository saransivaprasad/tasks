<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //dd($guard);
        if (Auth::guard($guard)->check()) {
            if ($guard == "admin") {
                return redirect()->route('admin.home');
            } elseif ($guard == "marketing") {
                return redirect()->route('marketing.home');
            } else {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}