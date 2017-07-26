@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Orders</div>

                    <div class="panel-body">
                        @include('partials.flash')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @if(!$orders->isEmpty())
                                        <th><input type="checkbox" class="checkbox_all"></th>
                                    @endif
                                    <th style="width: 75px;">Order ID</th>
                                    <th>User Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th style="width: 75px;">Total</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>
                                        @if($order->getIPNStatus() !== 'Canceled' && $order->getIPNStatus() !== 'Finished')
                                        <input type="checkbox" class="checkbox_delete" name="entries_to_delete[]" value="{{ $order->id }}" />
                                        @endif
                                    </td>
                                    <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                                    <td><a href="{{ route('users.show', $order->user->id) }}">{{ $order->user->name }}</a></td>
                                    <td>{{ $order->user->address }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                    <td>{{ $order->getIPNStatus() }}</td>
                                    <td>$ {{ $order->total }}</td>
                                    <td>
                                        <a href="{{ route('payment', $order->id) }}" class="btn btn-default">Checkout</a>
                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Are you sure?');">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No entries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <form action="{{ route('orders.cancel_mass') }}" method="post" onsubmit="return confirm('Are you sure?');">
                            {{ csrf_field() }}
                            <input type="hidden" name="ids" id="ids" value="" />
                            <input type="submit" value="Cancel selected" class="btn btn-danger" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function getIDs()
        {
            var ids = [];
            $('.checkbox_delete').each(function () {
                if($(this).is(":checked")) {
                    ids.push($(this).val());
                }
            });
            $('#ids').val(ids.join());
        }

        $(".checkbox_all").click(function(){
            $('input.checkbox_delete').prop('checked', this.checked);
            getIDs();
        });

        $('.checkbox_delete').change(function() {
            getIDs();
        });
    </script>
@endsection