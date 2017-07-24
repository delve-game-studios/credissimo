<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;


class ShopController extends Controller
{
    public function index(Request $request) {
    	if($request->has('search')) {
    		$products = Product::search($request->search)->get();
    	} else {
	    	$products = Product::all();
	    }
    	return view('shop', compact('products'));
    }

    public function show($slug) {
    	$product = Product::where('slug', $slug)->first();
    	$interested = Product::where('slug', '!=', $slug)->get()->random(4);
    	// var_dump($product, $interested);exit;
    	return view('product', compact('product', 'interested'));
    	// return view('product', compact('product', 'interested'));
    }
}
