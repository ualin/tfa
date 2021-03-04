<?php

namespace App\Http\Controllers;

use App\Notifications\TwoFactorPass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.otp');
    }

    public function verifyPass(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|max:6'
        ]);

        $userId = Session::get('user_identified');
        $user = User::find($userId);
        

        if($data['code'] === $user->two_factor_pass && $user->two_factor_pass_expires_at->gte(now()))
        {
            //the otp is succesfuly veryfied and the user can access the secured area
            $user->resetTwoFactorPass();
            Auth::login($user);

            return redirect('home');
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->withErrors(['otp'=>'The two factor authentication failed or expired.']);
    }
}
