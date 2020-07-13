<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $fillable = ['coupon_id' , 'discount'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
