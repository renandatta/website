@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">@if($id == 'new') Add new Pages {{ $code }} @else Edit Pages @endif</div>
                    <div class="card-body">
                        <form action="{{ url('admin/pages/save/'.$id) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="code" value="{{ $code }}">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="content">{{ ucwords(str_replace("_"," ","content")) }}</label>
                                        <textarea name="content" id="content" class="summernote">@if($id != 'new') {{ $field->content }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="title">{{ ucwords(str_replace("_"," ","title")) }}</label>
                                        <input type="text" class="form-control" id="title" name="title" @if($id != 'new') value="{{ $field->title }}" @endif required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ ucwords(str_replace("_"," ","slug")) }}</label>
                                        <input type="text" class="form-control" id="slug" name="slug" @if($id != 'new') value="{{ $field->slug }}" @endif required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Pages</button>
                                        <a href="{{ url('admin/pages') }}" class="btn btn-link">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jspage')
    <script>
        $('#title').focusout(function () {
            slug = $('#title').val().replace(/\ /g,'_').toLowerCase();
            $('#slug').val(slug);
        });
    </script>
@endsection