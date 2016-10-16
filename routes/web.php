<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    /*
    if(Auth::check()) {
    */
        return redirect('/dashboard');
    /*
    } else {
        return view('welcome');
    }
    */
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('scan', 'ScanController');

/*
Route::group(['middleware' => 'auth'], function () {  
      Route::resource('scan', 'ScanController');
});
*/

