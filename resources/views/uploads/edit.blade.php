@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Product</div>

                    <div class="panel-body">
                        @if ($errors->count() > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            Name:
                            <br />
                            <input type="text" name="name" value="{{ $product->name }}" />
                            <br /><br />
                            
                            Description:
                            <br />
                            <textarea name="description" cols="80" rows="6">{{ $product->description }}</textarea>
                            <br /><br />
                            
                            Image:
                            <br />
                            <input name="image" type="file">
                            <img src="{{ asset('img/' . $product->image) }}" style="width:50px;height:60px;" />
                            <br /><br />
                            
                            Price:
                            <br />
                            <input type="number" step="0.01" name="price" value="{{ $product->price }}" />
                            <br /><br />

                            <input type="submit" value="Submit" class="btn btn-default" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection