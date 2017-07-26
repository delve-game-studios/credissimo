@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>

                    <div class="panel-body">
                        @if (session('message'))
                            <div class="alert alert-info">{{ session('message') }}</div>
                        @endif
                        <p>
                            <a href="{{ route('products.create') }}" class="btn btn-default">New Product</a>
                        </p>
                        {{ $products->links() }} 
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="checkbox_all"></th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td><input type="checkbox" class="checkbox_delete" name="entries_to_delete[]" value="{{ $product->id }}" /></td>
                                    <td><a href="{{ route('products.show', ['id' => $product->id]) }}">{{ $product->name }}</a></td>
                                    <td>{{ $product->description }}</td>
                                    <td class="table-image"><img src="{{ asset('media/'. $product->image) }}" style="width:50px;"></td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-default">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No entries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}
                        <form action="{{ route('products.mass_destroy') }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="ids" id="ids" value="" />
                            <input type="submit" value="Delete selected" class="btn btn-danger" />
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