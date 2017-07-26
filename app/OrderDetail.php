<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	protected $fillable = ['product_id', 'order_id', 'qty'];

	public function product() {
		return $this->hasOne('App\Product', 'id', 'product_id');
	}
}
