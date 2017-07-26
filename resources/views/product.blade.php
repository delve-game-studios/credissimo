@extends('layouts.app')

@section('content')
	<div class="container">
		<p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->name }}</p>
		<div class="row">
			<h1>{{ $product->name }}</h1>
			<hr>

			<div class="col-md-4">
				<div class="thumbnail">
					<img src="{{ asset('media/'. $product->image) }}" alt="{{ $product->name }}" class="img-responsive">
				</div>
			</div>
			<div class="col-md-8">
				<h3>{{ $product->name }}</h3>
				<h3>$ {{ $product->price }}</h3>
				<p>{{ $product->description }}</p>
				<div class="row">
					<div class="col-md-2">
						<form action="{{ route('cart.store') }}" method="POST" class="sid-by-side">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $product->id }}">
							<input type="hidden" name="name" value="{{ $product->name }}">
							<input type="hidden" name="price" value="{{ $product->price }}">
							<input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="spacer"></div>
		@if(!$interested->isEmpty())
			<div class="row">
				<h3>You may also like...</h3>
				@foreach($interested as $product)
					<div class="col-md-3">
						<div class="thumbnail">
							<div class="caption text-center">
								<a href="{{ route('shop.show', $product->slug) }}">
									<img src="{{ asset('media/'. $product->image) }}" alt="{{ $product->name }}" class="img-responsive">
									<h3>{{ $product->name }}</h3>
									<p>$ {{ $product->price }}</p>
								</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif
	</div>

@endsection