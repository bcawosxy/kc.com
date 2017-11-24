<?php
//KC Route Group
Route::group(['prefix'=>'/', 'as'=>'KC::'], function() {
	Route::get('/', ['as' => 'index', 'uses'=> 'KcController@index']) ;
//	Route::get('/index/{page?}', ['as' => 'index', 'uses'=> 'PindeltaController@index']) ;
//
//	Route::get('/categoryarea/{id?}/{page?}', ['as' => 'categoryarea', 'uses'=> 'PindeltaController@categoryarea']) ;
//
//	Route::get('/about', ['as' => 'about', 'uses'=> 'PindeltaController@about']) ;
//
//	Route::get('/contact', ['as' => 'contact', 'uses'=> 'PindeltaController@contact']) ;
//	Route::post('/contact/add', ['uses' => 'PindeltaController@contactAdd']);
//
//	Route::get('/login', ['as' => 'login' , 'uses' => 'PindeltaController@ShowLoginPage']);
//	Route::post('login', ['uses' => 'PindeltaController@login']);
});
