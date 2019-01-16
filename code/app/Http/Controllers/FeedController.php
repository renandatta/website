<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{
    public function index($search = 'all', $mode = null){
        Session::put('menu_active','feed');
        $query = Feed::select('feeds.*');
        $ioController = new IoController();
        $query = $ioController->search_tool($query,$search);
        if($mode == null) {
            $data = $query->paginate(10);
            return view('admin.feed.index')
                ->with('search', $search)
                ->with('data', $data);
        }else{
            return $query->get();
        }
    }

    public function search(Request $request){
        $search = '';
        if($request->input('keyword') != ''){
            $search .= 'title'.',like,'.$request->input('keyword').';';
        }
        if($search != ''){
            $search = '/'.$search;
        }
        return redirect('admin/feed'.$search);
    }

    public function info($id){
        $field = [];
        if($id != 'new'){
            $field = Feed::find($id);
        }
        return view('admin.feed.info')
            ->with('id', $id)
            ->with('field', $field);
    }

    public function save(Request $request, $id){
        if($id == 'new'){
            $field = Feed::create($request->all());
            $action = "added";
        }else{
            $field = Feed::find($id);
            $field->update($request->all());
            $action = "updated";
        }
        if($request->hasFile('image')){
            if(($id != 'new') and (Storage::exists('feed/'.$field->image))){
                unlink(storage_path('app/feed/'.$field->image));
            }
            $filename = str_random(60).'.'.$request->file('image')->extension();
            Storage::putFileAs('feed',$request->file('image'),$filename);
            $field->image = $filename;
            $field->save();
        }
        $ioController = new IoController();
        $ioController->save_user_log(null,$request->input('_token'),$action,"users;".json_encode($field));
        $message['type'] = 'success';
        $message['content'] = "Feed Successfully ".ucwords($action);
        return redirect('admin/feed')
            ->with('message',$message);
    }

    public function delete(Request $request,$id){
        $field = Feed::find($id);
        try {
            $field->delete();
            $ioController = new IoController();
            $ioController->save_user_log(null,$request->input('_token'),"deleted","users;".json_encode($field));
            $message['type'] = 'success';
            $message['content'] = "Feed Successfully Deleted";
        } catch (\Exception $e) {
            $message['type'] = 'danger';
            $message['content'] = "Feed Cannot Deleted";
        }
        return redirect('admin/feed')
            ->with('message',$message);
    }
}
