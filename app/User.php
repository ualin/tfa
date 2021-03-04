<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_pass'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'two_factor_pass_expires_at',
    ];

    public function generateTwoFactorPass()
    {
        $this->timestamps = false;
        $this->two_factor_pass = random_int(100000,999999);
        $this->two_factor_pass_expires_at = now()->addSeconds(120);
        $this->save();
    }

    public function resetTwoFactorPass()
    {
        $this->timestamps = false;
        $this->two_factor_pass = null;
        $this->two_factor_pass_expires_at = null;
        $this->save();
    }
}
