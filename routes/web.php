<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('index', function(){
    $record = DB::table('records')
                  ->where('idAndroid', '6c9c95d9e4475c98')->get();

    return response()->json([
        'record' => $record
    ]);

});