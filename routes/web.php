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
	Route::get('/login', ['as' => 'login' , 'uses' => 'KcController@ShowLoginPage']);
	Route::post('login', ['uses' => 'KcController@login']);
});

//KC Admin Route Group
Route::group(['prefix'=>'admin', 'as'=>'admin::'], function() {
    // index , 圖表
    Route::get('/', ['as' => 'index', 'uses'=> 'AdminController@index']) ;
//
//    //關於品利興
//    Route::get('/about', ['as' => 'about', 'uses'=> 'AdminController@about']) ;
//    Route::post('/about', ['as' => 'about', 'uses'=> 'AdminController@aboutEdit']) ;
//
//    //產品類別
//    Route::get('/categoryarea', ['as'=> 'categoryarea', 'uses'=> 'AdminController@categoryarea']) ;
//    Route::get('/categoryarea/content/{id?}', ['as'=> 'categoryarea_content', 'middleware' => 'DBCheck','uses'=> 'AdminController@categoryarea_content']);
//    Route::post('/categoryarea/delete/', ['uses'=> 'AdminController@categoryareaDelete']) ;
//    Route::post('/categoryarea/edit/', ['uses'=> 'AdminController@categoryareaEdit']) ;
//
//    //產品項目
//    Route::get('/category', ['as'=> 'category', 'uses'=> 'AdminController@category']) ;
//    Route::get('/category/content/{id?}', ['as'=> 'category_content', 'middleware' => 'DBCheck', 'uses'=> 'AdminController@category_content']) ;
//    Route::post('/category/delete/', ['uses'=> 'AdminController@categoryDelete']) ;
//    Route::post('/category/edit/', ['uses'=> 'AdminController@categoryEdit']) ;
//
//    //產品
//    Route::get('/product', ['as'=> 'product', 'uses'=> 'AdminController@product']) ;
//    Route::get('/product/content/{id?}', ['as'=> 'product_content', 'middleware' => 'DBCheck', 'uses'=> 'AdminController@product_content']) ;
//    Route::post('/product/delete/', ['uses'=> 'AdminController@productDelete']) ;
//    Route::post('/product/edit/', ['uses'=> 'AdminController@productEdit']) ;
//
//    //社群網站連結
//    Route::get('/sociallink', ['as'=> 'sociallink', 'uses'=> 'AdminController@sociallink']) ;
//    Route::post('/sociallink/edit/', ['uses'=> 'AdminController@sociallinkEdit']) ;
//
//    //聯絡我們
//    Route::get('/contact', ['as'=> 'contact', 'uses'=> 'AdminController@contact']) ;
//    Route::get('/contact/content/{id?}', ['as'=> 'contact_content', 'middleware' => 'DBCheck', 'uses'=> 'AdminController@contact_content']) ;
//    Route::post('/contact/delete/', ['uses'=> 'AdminController@contactDelete']) ;
//    Route::post('/contact/edit/', ['uses'=> 'AdminController@contactEdit']) ;
//
//    //產品詢價
//    Route::get('/inquiry', ['as'=> 'inquiry', 'uses'=> 'AdminController@inquiry']) ;
//    Route::get('/inquiry/content/{id?}', ['as'=> 'inquiry_content', 'middleware' => 'DBCheck', 'uses'=> 'AdminController@inquiry_content']) ;
//    Route::post('/inquiry/delete/', ['uses'=> 'AdminController@inquiryDelete']) ;
//    Route::post('/inquiry/edit/', ['uses'=> 'AdminController@inquiryEdit']) ;
//
//    //系統參數
//    Route::get('/system', ['as'=> 'system', 'uses'=> 'AdminController@system']) ;
//    Route::post('/system/edit', ['as'=> 'system_edit', 'uses'=> 'AdminController@systemEdit']) ;
//
//    //管理員清單
//    Route::get('/admins', ['as'=> 'admins', 'uses'=> 'AdminController@admins']) ;
//    Route::post('/admins/edit', ['as'=> 'admins_edit', 'uses'=> 'AdminController@adminsEdit']) ;
//
//    //登出
//    Route::get('/logout', ['as'=> 'logout', 'uses'=> 'AdminController@logout']) ;
//
//    //檔案上傳
//    Route::post('/fileUpload/', ['as' => 'fileUpload', 'uses'=> 'AdminController@fileUpload']) ;
});