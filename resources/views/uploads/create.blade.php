@extends('layouts.app')

@section('title')
Uploading file
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Upload</div>

                    <div class="panel-body">
                        @if ($errors->count() > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('uploads.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}                            
                            <div class="row">
                                <div class="col-md-10">
                                    File:
                                    <br />
                                    <div class="file-group">
                                        <input name="file" type="file">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" role="button" class="more-files">Add file</button>
                                </div>
                            </div>
                            <br><br>
                            <input type="submit" value="Submit" class="btn btn-default" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).on('click', '.more-files', function(e) {
        var name = $('form input[type=file]').first().attr('name');

        if(!name.slice(-2) === '[]') {
            $('form input[type=file]').first().attr('name', name + '[]');
        }

        newField = document.createElement('input');
        newField.type = 'file';
        newField.name = name + '[]';

        $('form div.file-group').append('<br>').append(newField);
    });
</script>
@endsection