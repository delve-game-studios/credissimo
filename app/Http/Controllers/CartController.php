<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use App\Product;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $pendingOrders = $this->getPendingOrders(Auth::user()->id);
    	return view('cart', compact('pendingOrders'));
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

    public function getPayment($order_id = false) {
        if(!!$order_id) {
            $order = Order::findOrFail($order_id);
            return view('checkout.payment', compact('order'));
        }
        return view('checkout.payment');
    }

    public function getStripe() {
        $total = Cart::total();
        return view('checkout.stripe', compact('total'));
    }

    public function postStripe(Request $request) {

    }
    

    public function getPendingOrders($user_id) {
        return Order::where(['user_id' => $user_id, 'status' => 0])->get();
    }
}
