<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use App\Product;
use App\Order;
use App\OrderDetail;

class CartController extends Controller
{
    public function index() {
    	return view('cart');
    }

    public function addCart(Request $request) {
    	$duplicates = Cart::search(function($cartItem, $rowId) use($request) {
    		return $cartItem->id === $request->id;
    	});
    	if(!$duplicates->isEmpty()) {
    		return redirect()->route('cart.index')->with('success', 'Product is already in your cart.');
    	}

    	Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
    	return redirect()->back()->with('success', 'Product has been added to your cart.');
    }

    public function updateCart(Request $request, $rowId) {
    	Cart::update($rowId, $request->qty);
    	return back()->with('success', 'Updated successfully!');
    }

    public function deleteCart($rowId) {
    	Cart::remove($rowId);
    	return back()->with('success', 'Removed successfully!');
    }

    public function getPayment() {
        return view('checkout.payment');
    }

    public function getStripe() {
        $total = Cart::total();
        return view('checkout.stripe', compact('total'));
    }

    public function postStripe(Request $request) {

    }
}
