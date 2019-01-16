@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    @php
                        $message = Session::get('message');
                    @endphp
                    <div class="alert alert-{{ $message['type'] }}" role="alert">
                        {{ $message['content'] }}
                    </div>
                @endif
                <div class="card mt-3">
                    <div class="card-header card-header-tab">
                        <ul class="nav nav-tabs" id="tabProfile" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-black-50 @if($tab == '1') active show @endif"
                                   id="menu-tab1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black-50 @if($tab == '2') active show @endif"
                                   id="menu-tab2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab1" aria-selected="true">Images</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black-50 @if($tab == '3') active show @endif"
                                   id="menu-tab3" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab2" aria-selected="false">Office</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black-50 @if($tab == '4') active show @endif"
                                   id="menu-tab4" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab2" aria-selected="false">Social Media</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabProfileContent">
                            <div class="tab-pane @if($tab == '1') active show @endif" id="tab1" role="tabpanel" aria-labelledby="menu-tab1">
                                <form action="{{ url('admin/profile/save/information') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="title">{{ ucwords(str_replace("_"," ","title")) }}</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $profile->title }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ ucwords(str_replace("_"," ","description")) }}</label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ $profile->description }}" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Information</button>
                                        <a href="{{ url('admin/profile/1') }}" class="btn btn-link">Cancel</a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane @if($tab == '2') active show @endif" id="tab2" role="tabpanel" aria-labelledby="menu-tab2">
                                <form action="{{ url('admin/profile/save/images') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="favicon">{{ ucwords(str_replace("_"," ","favicon")) }}</label>
                                                <input type="file" class="dropify"
                                                       id="favicon" name="favicon"
                                                       data-allowed-file-extensions="png" data-height="300"
                                                       @if((!empty($profile)) and ($profile->favicon != ''))
                                                       data-default-file="{{ asset('storage/profile/'.$profile->favicon) }}"
                                                        @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="logo_square">{{ ucwords(str_replace("_"," ","logo_square")) }}</label>
                                                <input type="file" class="dropify"
                                                       id="logo_square" name="logo_square"
                                                       data-allowed-file-extensions="jpeg jpg png" data-height="300"
                                                       @if((!empty($profile)) and ($profile->logo_square != ''))
                                                       data-default-file="{{ asset('storage/profile/'.$profile->logo_square) }}"
                                                        @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo_horizontal">{{ ucwords(str_replace("_"," ","logo_horizontal")) }}</label>
                                        <input type="file" class="dropify"
                                               id="logo_horizontal" name="logo_horizontal"
                                               data-allowed-file-extensions="jpeg jpg png" data-height="250"
                                               @if((!empty($profile)) and ($profile->logo_horizontal != ''))
                                               data-default-file="{{ asset('storage/profile/'.$profile->logo_horizontal) }}"
                                                @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo_white">{{ ucwords(str_replace("_"," ","logo_white")) }}</label>
                                        <input type="file" class="dropify"
                                               id="logo_white" name="logo_white"
                                               data-allowed-file-extensions="jpeg jpg png" data-height="250"
                                               @if((!empty($profile)) and ($profile->logo_white != ''))
                                               data-default-file="{{ asset('storage/profile/'.$profile->logo_white) }}"
                                                @endif>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Images</button>
                                        <a href="{{ url('admin/profile/2') }}" class="btn btn-link">Cancel</a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane @if($tab == '3') active show @endif" id="tab3" role="tabpanel" aria-labelledby="menu-tab3">
                                <form action="{{ url('admin/profile/save/office') }}" method="post">
                                    {{ csrf_field() }}
                                    <textarea title="" type="text" name="office" id="office" style="display: none;"></textarea>
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <td colspan="2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Office Name</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="office_name" name="office_name" placeholder="">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-default" onclick="addNewOffice()">Add New</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody id="listOffice">

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Save Office</button>
                                                    <a href="{{ url('admin/profile/3') }}" class="btn btn-link">Cancel</a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                            <div class="tab-pane @if($tab == '4') active show @endif" id="tab4" role="tabpanel" aria-labelledby="menu-tab3">
                                <form action="{{ url('admin/profile/save/social') }}" method="post">
                                    {{ csrf_field() }}
                                    <textarea title="" type="text" name="social" id="social" style="display: none;"></textarea>
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <td colspan="2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select name="social_media_type" id="social_media_type" class="form-control" title="">
                                                            <option value="facebook">Facebook</option>
                                                            <option value="twitter">Twitter</option>
                                                            <option value="instagram">Instagram</option>
                                                            <option value="youtube">Youtube</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control" id="social_media_value" name="social_media_value" placeholder="">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-default" onclick="addNewSocial()">Add New</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody id="listSocial">

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Save Social Media</button>
                                                    <a href="{{ url('admin/profile/4') }}" class="btn btn-link">Cancel</a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jspage')
    <script>
        var office = "{{ $profile->office }}";
        if(office !== ""){
            office = JSON.parse(office.replace(/&quot;/g,'"'));
        }else{
            office = [];
        }
        displayOffice();
        function addNewOffice() {
            var item = {};
            item['name'] = $('#office_name').val();
            item['contact'] = [];
            office.push(item);
            $('#office_name').val('');
            displayOffice();
        }
        function saveContact(index) {
            office[index]['contact'].push({
                type : $('#contact_type'+index).val(),
                value : $('#contact_value'+index).val()
            });
            displayOffice();
        }
        function deleteOffice(index) {
            office.splice(index,1);
            displayOffice();
        }
        function deleteContact(index,index2) {
            office[index]['contact'].splice(index2,1);
            displayOffice();
        }
        function displayOffice(){
            $('#listOffice').html('');
            for(var i = 0; i < office.length; i++){
                $('#listOffice').append('<tr>\n' +
                        '<td style="border-top:1px solid #000;">Office Name : <b>'+office[i]['name']+'</b></td>\n' +
                        '<td class="text-right"><a href="javascript:void(0)" onclick="deleteOffice('+i+')">Delete</a></td>\n' +
                    '</tr>');
                for(var a = 0; a < office[i]['contact'].length; a++){
                    $('#listOffice').append('<tr>\n'+
                            '<td style="padding-top: 0;">'+office[i]['contact'][a]['type']+' : <b>'+office[i]['contact'][a]['value']+'</b></td>\n' +
                            '<td style="padding-top: 0;" class="text-right"><a href="javascript:void(0)" onclick="deleteContact('+i+','+a+')">Delete</a></td>\n' +
                        '</tr>');
                }
                var rowAction = '<tr><td colspan="2" style="padding-top: 0;">\n' +
                    '<div class="input-group">\n' +
                        '<div class="input-group-prepend">\n' +
                            '<select name="contact_type'+i+'" id="contact_type'+i+'" class="form-control">\n' +
                                '<option>Address</option>\n' +
                                '<option>Phone</option>\n' +
                                '<option>Fax</option>\n' +
                                '<option>Whatsapp</option>\n' +
                                '<option>BBM</option>\n' +
                                '<option>Email</option>\n' +
                            '</select>'+
                        '</div>'+
                        '<input type="text" class="form-control" id="contact_value'+i+'" name="contact_value'+i+'" placeholder="">\n' +
                        '<div class="input-group-append">\n' +
                            '<button type="button" class="btn btn-default" onclick="saveContact('+i+')">Save</button>\n' +
                        '</div>\n' +
                    '</div>'
                +'</td></tr>';
                $('#listOffice').append(rowAction);
            }
            $('#office').val(JSON.stringify(office));
        }

        //=============================================================================================================

        var social = "{{ $profile->social }}";
        if(social !== ""){
            social = JSON.parse(social.replace(/&quot;/g,'"'));
        }else{
            social = [];
        }
        displaySocial();
        function addNewSocial() {
            social.push({
                type : $('#social_media_type').val(),
                value : $('#social_media_value').val()
            });
            $('#social_media_value').val();
            displaySocial();
        }
        function deleteSocial(index) {
            social.splice(index,1);
            displaySocial();
        }
        function displaySocial(){
            $('#listSocial').html('');
            for(var i = 0; i < social.length; i++){
                $('#listSocial').append('<tr>\n' +
                    '<td style="padding-top: 5px;padding-bottom: 5px;">'+social[i]['type']+' : <b><a target="_blank" href="'+social[i]['value']+'">'+social[i]['value']+'</a></b></td>\n' +
                    '<td style="padding-top: 5px;padding-bottom: 5px;" class="text-right"><a href="javascript:void(0)" onclick="deleteSocial('+i+')">Delete</a></td>\n' +
                    '</tr>');
            }
            $('#social').val(JSON.stringify(social));
        }
    </script>
@endsection