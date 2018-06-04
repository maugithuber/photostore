<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('profile','UserController@profile');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/store_event', 'EventController@store');
Route::post('/store_photo{id}', 'PhotoController@store');

Route::get('/view_photos{id}', 'PhotoController@view_photos');
Route::get('/up_photos{id}', 'PhotoController@upload_photos');

Route::get('add_cart{id}','DetailController@add_cart');
Route::get('shopping', 'DetailController@getCart');
Route::get('/remove{id}', 'DetailController@getRemove');


//enviar pedido a paypal
Route::get('payment',[
    'as' =>'payment',
    'uses'=>'PaypalController@postPayment'
]);
//paypal redirecciona a esta ruta
Route::get('payment_status',[
     'as' =>'payment.status',
    'uses'=>'PaypalController@getPaymentStatus'
]);

Route::get('myphotos',[
    'as' =>'myphotos',
    'uses'=>'ClientController@myphotos'
]);

Route::get('download{id}','PhotoController@download');
Route::get('filter{event_id}','PhotoController@filter');

Route::post('subscribe','SubscriptionController@subscribe');
Route::get('subscribeurl{id}','SubscriptionController@subscribeurl');
Route::get('/view_event{id}', 'EventController@view_event');


