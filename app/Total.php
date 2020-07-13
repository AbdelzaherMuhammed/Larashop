<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{

    protected $fillable = ['cart_total' , 'discount' , 'user_id' , 'grand_total'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
