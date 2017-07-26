<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentService extends Model
{
    protected $fillable = ['name'];

    public function orders() {
    	return $this->belongsToMany('App\Order', 'ipn_id');
    }
}
