<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','city','country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isRole()
    {
        return $this->role;
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function coupons()
    {
        return $this->belongsToMany('App\Coupon');
    }

    public function totals()
    {
        return $this->hasMany('App\Total');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

}
