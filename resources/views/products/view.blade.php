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
			<button class="btn btn-warning" href="{{ route('products.edit', $product->id) }}">
				<span>Edit Product</span>
			</button>
			<button class="btn btn-danger" href="{{ route('products.destroy', $product->id) }}">
				<span>Delete</span>
			</button>
		</div>
	</div>
</div>
@endsection