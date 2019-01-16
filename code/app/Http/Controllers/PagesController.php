<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function index($search = 'all', $mode = null){
        Session::put('menu_active','pages');
        $query = Pages::select('*');
        $ioController = new IoController();
        $query = $ioController->search_tool($query,$search);
        if($mode == null) {
            $data = $query->paginate(10);
            return view('admin.pages.index')
                ->with('search', $search)
                ->with('data', $data);
        }else{
            return $query->get();
        }
    }

    public function search(Request $request){
        $search = '';
        if($request->input('keyword') != ''){
            $search .= 'user_level'.',like,'.$request->input('keyword').';';
        }
        if($search != ''){
            $search = '/'.$search;
        }
        return redirect('admin/pages'.$search);
    }

    public function info($id, $parent = ''){
        $field = [];
        if($id != 'new'){
            $field = Pages::find($id);
            $code = $field->code;
        }else{
            $code = $this->get_code($parent);
        }

        return view('admin.pages.info')
            ->with('id', $id)
            ->with('field', $field)
            ->with('code',$code);
    }

    public function save(Request $request, $id){
        if($id == 'new'){
            $field = Pages::create($request->all());
            $action = "added";
        }else{
            $field = Pages::find($id);
            $field->update($request->all());
            $action = "updated";
        }
        $ioController = new IoController();
        $ioController->save_user_log(null,$request->input('_token'),$action,"user_levels;".json_encode($field));
        $message['type'] = 'success';
        $message['content'] = "Pages Successfully ".ucwords($action);
        return redirect('admin/pages')
            ->with('message',$message);
    }

    public function delete(Request $request,$id){
        $field = Pages::find($id);
        try {
            $field->delete();
            $ioController = new IoController();
            $ioController->save_user_log(null,$request->input('_token'),"deleted","user_levels;".json_encode($field));
            $message['type'] = 'success';
            $message['content'] = "Pages Successfully Deleted";
        } catch (\Exception $e) {
            $message['type'] = 'danger';
            $message['content'] = "Pages Cannot Deleted";
        }
        return redirect('admin/pages')
            ->with('message',$message);
    }

    public function get_code($parent){
        $last = Pages::where('code','like',$parent.'.%')->orderBy('code','desc')->first();
        if(!empty($last)){
            $code = (int)$last->code+1;
        }else{
            $code = 1;
        }
        if(strlen($code) == 1){
            $code = '0'.$code;
        }
        if($parent != ''){
            $code = $parent.'.'.$code;
        }
        return $code;
    }
}
