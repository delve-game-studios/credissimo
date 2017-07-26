@extends('layouts.app')

@section('title')
Credissimo - File Manager
@endsection

@section('content')
    <div class="container">
    <div class="row" id="top-panel">
        @include('partials.flash')
        <div style="display:inline-block;">
            <a href="{{ route('uploads.create') }}" class="btn btn-default">New Upload</a>
        </div>
        <div class="mass-actions" style="display:inline-block;">
            <form id="mass_action" method="POST" action="" onsubmit="return confirm('Are you sure?');">
                {{csrf_field()}}
                <input id="ids" type="hidden" name="ids"/>
                <input type="hidden" name="_method" value=""/>

                <!-- Single button -->
                <div class="btn-group">
                    <button type="submit" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li onclick="formMassAction('{{ route('uploads.mass_destroy') }}', 'DELETE');" class="btn-danger"><a href="javascript:void(0)">Delete</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div><hr>
    @if(!$uploads->isEmpty())
    <div class="col-md-9">
        <div class="row">
            @foreach($uploads as $item)
            <div class="col-sm-6 col-md-2">
                <button class="thumbnail" type="button" data-id="{{ $item->id }}">
                    <img class="" src="{{ asset('media/uploads/' . Auth::user()->id . '/' . $item->thumbnail) }}" alt="{{ $item->title }}">
                </button>
            </div>
            @endforeach
        </div>
        @else
        <h3>Nothing to show</h3>
        @endif
        </div>
    </div>
    <div class="col-md-3"></div>
@endsection

@section('scripts')
<script type="text/javascript">
    function getAllSelectedThumbnails() {
        var ids = [];
        
        $('button.thumbnail.selected', document).each(function(k,v) {
            ids.push($(v).data('id'));
        });

        $('form#mass_action #ids', document).val(ids.join(','));
    }

    function formMassAction(route, method) {
        $('form#mass_action').attr('action', route);
        $('form#mass_action > input[name=_method]').val(method);
        $('form#mass_action').submit();
    }

    $(document).on('click', 'button.thumbnail', function(e) {
        var button = e.target;
        if(button.tagName == 'IMG') {
            button = e.target.parentNode;
        }
        $(button).toggleClass('selected');
        getAllSelectedThumbnails();
    });
</script>

    <style type="text/css">
        button.thumbnail {
            outline: none;
        }
        button.thumbnail.selected {
            border: 4px solid rgba(51, 153, 255, 0.99);
        }
        button.thumbnail.selected:after {
            font-family: 'Glyphicons Halflings';
            content: "\e013";
            width: 34px;
            font-size: 12px;
            padding-top:10px;
            padding-bottom:10px;
            background: rgba(51, 153, 255, 0.99);
            color: white;
            display: block;
            position: absolute;
            top: 0;
            right: 15px;
            /*border: 1px solid white;*/
        }
    </style>
@endsection