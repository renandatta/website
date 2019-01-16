@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">@if($id == 'new') Add new User Level @else Edit User Level @endif</div>
                    <div class="card-body">
                        <form action="{{ url('admin/user_level/save/'.$id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="user_level">{{ ucwords(str_replace("_"," ","user_level")) }}</label>
                                <input type="text" class="form-control" id="user_level" name="user_level" @if($id != 'new') value="{{ $field->user_level }}" @endif required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="credentials">{{ ucwords(str_replace("_"," ","credentials")) }}</label>
                                <select name="credentials" id="credentials" class="form-control select2">
                                    <option value="full">Full</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save User Level</button>
                                <a href="{{ url('admin/user_level') }}" class="btn btn-link">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
