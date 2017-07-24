@extends('layouts.app')

@section('content')
	<div class="container">
		<p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->name }}</p>
		<h1>{{ $product->name }}</h1>
		<hr>

		<div class="col-md-4">
			<img src="{{ asset('img/'. $product->image) }}" alt="{{ $product->name }}" class="img-responsive">
		</div>
		<div class="col-md-8">
			<h3>{{ $product->name }}</h3>
			<h3>$ {{ $product->price }}</h3>
			<form action="{{ route('cart.store') }}" method="POST" class="sid-by-side">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $product->id }}">
				<input type="hidden" name="name" value="{{ $product->name }}">
				<input type="hidden" name="price" value="{{ $product->price }}">
				<input type="submit" class="btn btn-success btn-lg" value="AddToCart">
			</form>
			<br>

			<form action="" method="POST" class="sid-by-side">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $product->id }}">
				<input type="hidden" name="name" value="{{ $product->name }}">
				<input type="hidden" name="price" value="{{ $product->price }}">
				<input type="submit" class="btn btn-success btn-lg" value="ToWishList">
			</form>
			<br><br>
			{{ $product->description }}
		</div>

		<div class="spacer"></div>

		<div class="row">
			<h3>You may also like...</h3>
			@foreach($interested as $product)
				<div class="col-md-3">
					<div class="thumbnail">
						<div class="caption text-center">
							<a href="{{ route('shop.show', $product->slug) }}">
								<img src="{{ asset('img/'. $product->image) }}" alt="{{ $product->name }}" class="img-responsive">
							</a>
							<a href="{{ route('shop.show', $product->slug) }}">
								<h3>{{ $product->name }}</h3>
								<p>$ {{ $product->price }}</p>
							</a>
							<form action="{{ route('cart.store') }}" method="POST">
								{{ csrf_field() }}
								<button class="btn btn-success">
									<span class="glyphicon glyphicon-shopping-cart"></span>
								</button>
							</form>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

@endsection