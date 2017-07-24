<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
	use Searchable;

    protected $fillable = ['name', 'slug', 'price', 'description', 'image'];
    public $asYouType = true;

    public function orders() {
    	return $this->belongsToMany('App\Order', 'order_detail', 'product_id', 'order_id');
    }
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
