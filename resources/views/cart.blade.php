@extends('layouts.app')

@section('content')
	<div class="container">
		<p><a href="{{ url('/shop') }}">Shop</a></p>
		<h1>Your Cart</h1>
		<hr>
		@include('partials.flash')
		@if(!$pendingOrders->isEmpty())
		<div class="alert alert-warning">You have pending orders. Please review them <a href="{{ route('orders.history') }}">here</a></div>
		@endif
		@if(sizeof(Cart::content()) > 0)
			<table class="table">
				<thead>
					<th>Name</th>
					<th>Image</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity</th>
					<th>Price</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach(Cart::content() as $item)
					<tr>
						<td>
							<a href="{{ url('/shop', [$item->model->slug]) }}">{{ $item->name }}</a>
						</td>
						<td class="table-image">
							<a href="{{ url('/shop', [$item->model->slug]) }}">
								<img src="{{ asset('media/'. $item->model->image) }}" alt="{{ $item->name }}" class="img-responsive cart-image" style="width:70px;height:60px;" />
							</a>
						</td>
						<td>
							<form action="{{ route('cart.update', ['rowId' => $item->rowId]) }}" method="POST" class="row">
								{{csrf_field()}}
								<input type="text" name="qty" value="{{ $item->qty }}" class="col-md-1 col-md-offset-2">&nbsp;
								<input type="submit" class="btn btn-success col-md-3 col-md-offset-3" value="Update">
							</form>
						</td>
						<td>{{ $item->subtotal() }}</td>
						<td>
							<div class="row">
								<form action="{{ route('cart.destroy', ['rowId' => $item->rowId]) }}" method="GET" class="side-by-side">
									{{csrf_field()}}
									<input type="submit" class="btn btn-danger btn-sm" value="Remove">
								</form>
							</div>
						</td>
					</tr>
					@endforeach
					<tr>
						<td class="table-image"></td>
						<td></td>
						<td class="small-caps table-bg" style="text-align:right;">Sub Total</td>
						<td>$ {{ Cart::instance('default')->subtotal() }}</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td class="table-image"></td>
						<td></td>
						<td class="small-caps table-bg" style="text-align:right;">Tax</td>
						<td>$ {{ Cart::instance('default')->tax() }}</td>
						<td></td>
						<td></td>
					</tr>
					<tr class="border-bottom">
						<td class="table-image"></td>
						<td style="padding: 40px;"></td>
						<td class="small-caps table-bg" style="text-align:right;">Total</td>
						<td class="table-bg">$ {{ Cart::total() }}</td>
						<td class="column-spacer"></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
			&nbsp;
			<!-- <form action="{{ route('orders.store') }}" method="POST">
				<input type="hidden" name="">
			</form> -->
			<a href="{{ route('orders.create') }}" class="btn btn-success btn-lg">Order & Checkout</a>
		@else
			<h3>Your cart is empty</h3>
			<a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
		@endif
	</div>
@endsection