<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total', 'status', 'user_id'];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function products() {
    	return $this->belongsToMany('App\Product', 'order_detail', 'order_id', 'product_id');
    }
}
