@extends('layouts.app')

@section('title')
{{ $product->name }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="thumbnail">
				<img src="{{ asset('media/' . $product->image) }}">
			</div>
		</div>
		<div class="col-md-6">
			<div class="caption">
				<h3>{{ $product->name }}</h3>
			</div>
			<p>{{ $product->description }}</p>
			<br>
			<p class="price">$ {{ $product->price }}</p>
			<form action="{{ route('cart.store') }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $product->id }}">
				<input type="hidden" name="name" value="{{ $product->name }}">
				<input type="hidden" name="price" value="{{ $product->price }}">
				<button class="btn btn-success">
					<span>Add to Cart</span>
				</button>
				<button class="btn btn-info">
					<span>To Wishlist</span>
				</button>
			</form>
		</div>
	</div>
</div>
@endsection