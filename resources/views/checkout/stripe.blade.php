@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4 col-md-offset-3">
				<h1 style="color:red;font-weight:800;">Checkout</h1>
				<h4>Your total: $ {{ $total }}</h4>
				<div id="charge-errror" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
					{{ Session::get('error') }}
				</div>
				<form action="{{ route('payment.stripe') }}" method="POST" id="checkout-form">
					{{csrf_field()}}
					<div class="col-xs-12">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<label for="address">Address</label>
							<input type="text" name="address" id="address" class="form-control" placeholder="Address">
						</div>
					</div>
					<button class="btn btn-success button">Order</button>
				</form>
			</div>
		</div>

	</div>
@endsection