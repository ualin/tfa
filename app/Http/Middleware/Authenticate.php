<?php

namespace App\Http\Middleware;

use App\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;

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
        if (! $request->expectsJson())
        {
            $identifiedUser = Session::get('user_identified');
            $user = User::find($identifiedUser);

            if($user && $user->two_factor_pass)
            {
                // two factor authentication step 2 needs to be resolved 
                return route('otp.index');
            }
            return route('login');
        }
    }
}
