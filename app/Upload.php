<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = ['title', 'description', 'filename', 'thumbnail'];
}
