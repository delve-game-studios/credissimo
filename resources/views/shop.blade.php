@extends('layouts.app')

@section('title')
Shop - Main
@endsection

@section('content')
	<div class="container">
		@include('partials.flash')
		@foreach($products->chunk(4) as $items) 
			<div class="row">
				@foreach($items as $product)
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
									<input type="hidden" name="id" value="{{ $product->id }}">
									<input type="hidden" name="name" value="{{ $product->name }}">
									<input type="hidden" name="price" value="{{ $product->price }}">
									<button class="btn btn-success">
										<span class="glyphicon glyphicon-shopping-cart"></span>
									</button>
								</form>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endforeach
	</div>
@endsection