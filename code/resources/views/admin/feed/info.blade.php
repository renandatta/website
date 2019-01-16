@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">@if($id == 'new') Add new Feed @else Edit Feed @endif</div>
                    <div class="card-body">
                        <form action="{{ url('admin/feed/save/'.$id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">{{ ucwords(str_replace("_"," ","title")) }}</label>
                                <input type="text" class="form-control" id="title" name="title" @if($id != 'new') value="{{ $field->title }}" @endif required autofocus>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Feed</button>
                                <a href="{{ url('admin/feed') }}" class="btn btn-link">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
