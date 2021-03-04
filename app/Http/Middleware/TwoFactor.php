<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check())
        {
            // user is already authenticated
            return redirect('login');
        }

        $identifiedUser = Session::get('user_identified');
        $user = User::find($identifiedUser);

        if(!$user)
        {
            // user has not passed the credention login yet
            return redirect('login');
        }
        
        if($user->two_factor_pass_expires_at->lt(now()))
        {
            Auth::logout();
            return redirect('login');
        }


        return $next($request);
    }
}
