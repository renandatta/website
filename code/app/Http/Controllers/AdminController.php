<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('menu_active','dashboard');
        return view('admin.dashboard');
    }
}
