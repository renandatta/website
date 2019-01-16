@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">@if($id == 'new') Add new Feed @else Edit Feed @endif</div>
                    <div class="card-body">
                        <form action="{{ url('admin/feed/save/'.$id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="date">{{ ucwords(str_replace("_"," ","date")) }}</label>
                                                <input type="text" class="form-control datepicker" id="date" name="date" @if($id != 'new') value="{{ date('d-m-Y',strtotime($field->date)) }}" @endif required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="time">{{ ucwords(str_replace("_"," ","time")) }}</label>
                                                <input type="text" class="form-control timepicker" id="time" name="time" @if($id != 'new') value="{{ date('H:i:s',strtotime($field->time)) }}" @endif required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ ucwords(str_replace("_"," ","category")) }}</label>
                                        <input type="text" class="form-control" id="category" name="category" @if($id != 'new') value="{{ $field->category }}" @endif required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">{{ ucwords(str_replace("_"," ","tags")) }}</label>
                                        <input type="text" class="form-control" id="tags" name="tags" @if($id != 'new') value="{{ $field->tags }}" @endif required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">{{ ucwords(str_replace("_"," ","image")) }}</label>
                                        <input type="file" class="dropify"
                                               id="image" name="image"
                                               data-allowed-file-extensions="png jpeg jpg" data-height="200"
                                               @if((!empty($field)) and ($field->image != ''))
                                               data-default-file="{{ asset('storage/feed/'.$field->image) }}"
                                                @endif>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Feed</button>
                                        <a href="{{ url('admin/feed') }}" class="btn btn-link">Cancel</a>
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