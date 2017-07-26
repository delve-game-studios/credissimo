@extends('layouts.app')

@section('title')
Orders / Order #{{$order->id}}
@endsection

@section('content')

<div class="container">
	<div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p>
                    <a href="{{ route('orders.index') }}">Orders</a>
                    <span> / </span>
                    <span>Order #{{ $order->id }}</span>
                </p>
            </div>

            <div class="panel-body">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Order Details</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<th>Total</th>
											<th>Quantity</th>
											<th>IPN</th>
											<th>IPN Status</th>
										</thead>
										<tbody>
											<tr>
												<td>$ {{ $order->total }}</td>
												<td>{{ $order->getQty() }}</td>
												<td>{{ $order->paymentService->name }}</td>
												<td>{{ $order->getIPNStatus() }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">User Details</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<th>Name</th>
											<th>E-Mail</th>
											<th>Phone</th>
											<th>Address</th>
										</thead>
										<tbody>
											<tr>
												<td>{{ $order->user->name }}</td>
												<td>{{ $order->user->email }}</td>
												<td>{{ $order->user->phone }}</td>
												<td>{{ $order->user->address }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Products</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<th>ID</th>
											<th>Name</th>
											<th>Quantity</th>
											<th>Image</th>
											<th>Price</th>
										</thead>
										<tbody>
											@forelse($order->details as $detail)
											<tr>
												<td>{{ $detail->product_id }}</td>
												<td><a href="{{ route('products.show', $detail->product_id) }}">{{ $detail->product->name }}</a></td>
												<td>{{ $detail->qty }}</td>
												<td class="table-image">
													<img src="{{ asset('media/'. $detail->product->image) }}" style="width: 50px;">
												</td>
												<td>{{ $detail->product->price }}</td>
											</tr>
											@empty
											<tr>
												<td colspan="4" class="alert alert-warning">No products</td>
											</tr>
											@endforelse
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection