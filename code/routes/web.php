<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('storage/{folder}/{filename}', function ($folder,$filename){
    $path = storage_path('app/' . $folder . '/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','AuthController@login');
Route::post('admin/login','AuthController@login_proses');
Route::post('admin/logout','AuthController@logout');

Route::group(['middleware' => ['check_login']],function(){
    Route::get('admin','AdminController@dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('dashboard','AdminController@dashboard');

        Route::get('user_level/{search?}','UserLevelController@index');
        Route::post('user_level/search','UserLevelController@search');
        Route::get('user_level/info/{id}','UserLevelController@info');
        Route::post('user_level/save/{id}','UserLevelController@save');
        Route::delete('user_level/delete/{id}','UserLevelController@delete');

        Route::get('user/{search?}','UserController@index');
        Route::post('user/search','UserController@search');
        Route::get('user/info/{id}','UserController@info');
        Route::post('user/save/{id}','UserController@save');
        Route::delete('user/delete/{id}','UserController@delete');

        Route::get('profile/{tab?}','ProfileController@index');
        Route::post('profile/save/{tab}','ProfileController@save');

        Route::get('pages/{search?}','PagesController@index');
        Route::post('pages/search','PagesController@search');
        Route::get('pages/info/{id}/{parent?}','PagesController@info');
        Route::post('pages/save/{id}','PagesController@save');
        Route::delete('pages/delete/{id}','PagesController@delete');

        Route::get('feed/{search?}','FeedController@index');
        Route::post('feed/search','FeedController@search');
        Route::get('feed/info/{id}','FeedController@info');
        Route::post('feed/save/{id}','FeedController@save');
        Route::delete('feed/delete/{id}','FeedController@delete');
    });
});