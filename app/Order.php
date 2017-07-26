<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total', 'status', 'user_id'];
    protected $statuses = ['Pending', 'Finished', 'Canceled'];

    public function user() {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function products() {
    	return $this->belongsToMany('App\Product', 'order_details', 'order_id', 'product_id');
    }

    public function details() {
    	return $this->hasMany('App\OrderDetail', 'order_id', 'id');
    }

    public function paymentService() {
    	return $this->hasOne('App\PaymentService', 'id', 'ipn_id');
    }

    public function getQty() {
    	$count = 0;
    	foreach($this->details()->get() as $detail) {
    		$count += $detail->qty;
    	}
    	return $count;
    }

    public function getIPNStatus($statusName = false) {
    	if(!!$statusName) {
    		return array_search($statusName, $this->statuses);
    	}
    	return $this->statuses[$this->status];
    }

    public function getStatuses() {
    	return $this->statuses;
    }
}
