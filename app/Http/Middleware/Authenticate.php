<?php

namespace App\Http\Middleware;

use Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Route::is('admin.*')) {
                return route('admin.login');
            } elseif (Route::is('marketing.*')) {
                return route('marketing.login');
            } elseif (Route::is('support.*')) {
                return route('support.login');
            }
            return route('login');
        }
    }
}
