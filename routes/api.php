<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//servicio web
Route::group( ['prefix'=>'myservice'],function(){
    Route::group(['prefix'=>'client'],function(){
        Route::post('login',[
            'uses' => 'AndroidController@login'
        ]);
        Route::post('register',[
            'uses'=>'AndroidController@register'
        ]);

        
    });
});

