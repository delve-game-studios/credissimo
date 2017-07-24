<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
        	'name' => 'Playstation 1',
        	'slug' => 'playstation-1',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
        Product::insert([
        	'name' => 'Playstation 2',
        	'slug' => 'playstation-2',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
        Product::insert([
        	'name' => 'Playstation 3',
        	'slug' => 'playstation-3',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
        Product::insert([
        	'name' => 'Playstation 4',
        	'slug' => 'playstation-4',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
        Product::insert([
        	'name' => 'Playstation 5',
        	'slug' => 'playstation-5',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
        Product::insert([
        	'name' => 'Playstation 6',
        	'slug' => 'playstation-6',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
        Product::insert([
        	'name' => 'Playstation 7',
        	'slug' => 'playstation-7',
        	'description' => 'description goes here',
        	'price' => 399,
        	'image' => 'ps4.jpg',
    	]);
    }
}
