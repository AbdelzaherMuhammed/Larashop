<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['id','product_name' , 'product_code' , 'product_price' , 'product_image' , 'product_info' , 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
    protected $hidden = [
        'pivot'
    ];


}
