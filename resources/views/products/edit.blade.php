@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Product</div>

                    <div class="panel-body">
                        @if ($errors->count() > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            Title:
                            <br />
                            <input type="text" name="title" value="{{ $product->title }}" />
                            <br /><br />
                            
                            Description:
                            <br />
                            <textarea name="description" cols="80" rows="6">{{ $product->description }}</textarea>
                            <br /><br />
                            
                            Image:
                            <br />
                            <input name="image" type="file">
                            <img src="{{ $product->image_path }}" />
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