@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Choose payment method</h1>
		<a href="{{ route('stripe') }}" class="btn btn-success">Stripe</a>&nbsp;<a href="" class="btn btn-primary">Paypal</a>
		</div>
@endsection