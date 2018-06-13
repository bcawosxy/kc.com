<?php
//KC Route Group
Route::group(['prefix'=>'/', 'as'=>'KC::'], function() {
	Route::get('/', ['as' => 'index', 'uses'=> 'KcController@index']) ;
	Route::get('/about', ['as' => 'about', 'uses'=> 'KcController@about']) ;
	Route::get('/product/{page?}', ['as' => 'product', 'uses'=> 'KcController@product']) ;
	Route::get('/content/{id?}', ['as' => 'content', 'uses'=> 'KcController@content']) ;

	Route::get('/contact', ['as' => 'contact', 'uses'=> 'KcController@contact']) ;
	Route::post('/contact', ['uses' => 'KcController@contactAdd']);

	Route::get('/login', ['as' => 'login' , 'uses' => 'KcController@ShowLoginPage']);
	Route::post('login', ['uses' => 'KcController@login']);
});

//KC Admin Route Group
Route::group(['prefix'=>'admin', 'as'=>'admin::'], function() {
    // index , 圖表
    Route::get('/', ['as' => 'index', 'uses'=> 'AdminController@index']) ;

    //關於凱詮
    Route::get('/about', ['as' => 'about', 'uses'=> 'AdminController@about']) ;
    Route::post('/about', ['uses'=> 'AdminController@aboutEdit']) ;

    //聯絡我們
	Route::get('/contact', ['as' => 'contact', 'uses'=> 'AdminController@contact']) ;

    //服務項目
    Route::get('/service', ['as' => 'service', 'uses'=> 'AdminController@service']) ;
    Route::get('/service/get', ['uses'=> 'AdminController@getService']) ; //for Datatable
    Route::post('/service/edit', ['uses'=> 'AdminController@serviceEdit']) ;
    Route::post('/service/refresh', ['uses'=> 'AdminController@refreshService']) ;

	//實績案例管理
	Route::get('/product', ['as'=> 'product', 'uses'=> 'AdminController@product']) ;
	Route::get('/product/content/{id?}', ['as'=> 'productContent', 'uses'=> 'AdminController@productContent']) ;
	Route::post('/product/delete/', ['uses'=> 'AdminController@productDelete']) ;
	Route::post('/product/edit', ['uses'=> 'AdminController@productEdit']) ;

    //首頁實績案例展示設定
	Route::get('/showcase', ['as' => 'showcase', 'uses'=> 'AdminController@showcase']) ;
	Route::post('/showcase/update', ['as' => 'showcaseupdate', 'uses'=> 'AdminController@showcaseUpdate']) ;

    //聯絡資訊設定
	Route::get('/info', ['as' => 'info', 'uses'=> 'AdminController@info']) ;
	Route::post('/info/edit', ['uses'=> 'AdminController@infoEdit']) ;

    //橫幅圖片
	Route::get('/banner', ['as' => 'banner', 'uses'=> 'AdminController@banner']) ;
	Route::post('/banner/update', ['as' => 'bannerupdate','uses'=> 'AdminController@bannerEdit']) ;

	//管理員設定
	Route::get('/admins', ['as' => 'admins', 'uses'=> 'AdminController@admins']) ;
	Route::get('/admins/content/{id?}', ['as'=> 'adminsContent', 'uses'=> 'AdminController@adminsContent']) ;
	Route::post('/admins/delete/', ['uses'=> 'AdminController@adminsDelete']) ;
	Route::post('/admins/edit', ['uses'=> 'AdminController@adminsEdit']) ;

	//檔案上傳
	Route::post('/fileUpload/', ['as' => 'fileUpload', 'uses'=> 'AdminController@fileUpload']) ;

    //登出
    Route::get('/logout', ['as'=> 'logout', 'uses'=> 'AdminController@logout']) ;

});

Route::get('/.well-known/acme-challenge/{filename?}', ['uses'=> 'KcController@ssl']) ;