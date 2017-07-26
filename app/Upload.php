<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = ['title', 'description', 'filename', 'thumbnail', 'user_id'];

    public function user() {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
