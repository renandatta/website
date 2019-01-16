<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index($tab = '1'){
        Session::put('menu_active','profile');
        $profile = Profile::first();
        if(empty($profile)){
            $profile = Profile::create(['title' => 'Title', 'description' => 'Description']);
        }
        return view('admin.profile.index')
            ->with('tab',$tab)
            ->with('profile',$profile);
    }

    public function save(Request $request, $tab){
        $profile = Profile::first();
        $field = Profile::find($profile->id);
        $tab_index = 1;
        if($tab == 'information'){
            $field->title = $request->input('title');
            $field->description = $request->input('description');
            $tab_index = 1;
        }
        if($tab == 'images'){
            if($request->hasFile('favicon')){
                if(($field->favicon != '') and (Storage::exists('profile/'.$field->favicon))){
                    unlink(storage_path('app/profile/'.$field->favicon));
                }
                $filename = str_random(60).'.'.$request->file('favicon')->extension();
                Storage::putFileAs('profile',$request->file('favicon'),$filename);
                $field->favicon = $filename;
            }
            if($request->hasFile('logo_square')){
                if(($field->logo_square != '') and (Storage::exists('profile/'.$field->logo_square))){
                    unlink(storage_path('app/profile/'.$field->logo_square));
                }
                $filename = str_random(60).'.'.$request->file('logo_square')->extension();
                Storage::putFileAs('profile',$request->file('logo_square'),$filename);
                $field->logo_square = $filename;
            }
            if($request->hasFile('logo_horizontal')){
                if(($field->logo_horizontal != '') and (Storage::exists('profile/'.$field->logo_horizontal))){
                    unlink(storage_path('app/profile/'.$field->logo_horizontal));
                }
                $filename = str_random(60).'.'.$request->file('logo_horizontal')->extension();
                Storage::putFileAs('profile',$request->file('logo_horizontal'),$filename);
                $field->logo_horizontal = $filename;
            }
            if($request->hasFile('logo_white')){
                if(($field->logo_white != '') and (Storage::exists('profile/'.$field->logo_white))){
                    unlink(storage_path('app/profile/'.$field->logo_white));
                }
                $filename = str_random(60).'.'.$request->file('logo_white')->extension();
                Storage::putFileAs('profile',$request->file('logo_white'),$filename);
                $field->logo_white = $filename;
            }
            $tab_index = 2;
        }
        if($tab == 'office'){
            $field->office = $request->input('office');
            $tab_index = 3;
        }
        if($tab == 'social'){
            $field->social = $request->input('social');
            $tab_index = 4;
        }
        $field->save();
        $ioController = new IoController();
        $ioController->save_user_log(null,$request->input('_token'),"update","profiles;".json_encode($field));
        $message['type'] = 'success';
        $message['content'] = "Profile Successfully Saved";
        return redirect('admin/profile/'.$tab_index)
            ->with('message',$message);
    }
}
