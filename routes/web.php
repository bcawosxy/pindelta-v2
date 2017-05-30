<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', ['as' => 'login' , function () {
    return view('login');
}]);

//Admin Route Group
Route::group(['prefix'=>'admin', 'as'=>'admin::'], function() {
    // index , 圖表
    Route::get('/', ['as' => 'index', 'uses'=> 'AdminController@index']) ;

    //關於品利興
    Route::get('/about', ['as' => 'about', 'uses'=> 'AdminController@about']) ;

    //產品類別
    Route::get('/categoryarea', ['as'=> 'categoryarea', 'uses'=> 'AdminController@categoryarea']) ;
    //產品類別管理
    Route::get('/categoryarea/edit', ['as'=> 'categoryarea_edit', 'uses'=> 'AdminController@categoryarea_edit']) ;

    //產品項目
    Route::get('/category', ['as'=> 'category', 'uses'=> 'AdminController@category']) ;
    //產品項目管理
    Route::get('/category/edit', ['as'=> 'category_edit', 'uses'=> 'AdminController@category_edit']) ;

    //產品
    Route::get('/product', ['as'=> 'product', 'uses'=> 'AdminController@product']) ;
    //產品管理
    Route::get('/product/edit', ['as'=> 'product_edit', 'uses'=> 'AdminController@product_edit']) ;

    //社群網站連結
    Route::get('/sociallink', ['as'=> 'sociallink', 'uses'=> 'AdminController@sociallink']) ;

    //聯絡我們
    Route::get('/contact', ['as'=> 'contact', 'uses'=> 'AdminController@contact']) ;
    //聯絡我們管理
    Route::get('/contact/edit', ['as'=> 'contact_edit', 'uses'=> 'AdminController@contact_edit']) ;

    //產品詢價
    Route::get('/inquiry', ['as'=> 'inquiry', 'uses'=> 'AdminController@inquiry']) ;
    //產品詢價管理
    Route::get('/inquiry/edit', ['as'=> 'inquiry_edit', 'uses'=> 'AdminController@inquiry_edit']) ;

    //系統參數
    Route::get('/system', ['as'=> 'inquiry_edit', 'uses'=> 'AdminController@inquiry_edit']) ;

    //管理員清單
    Route::get('/admins', ['as'=> 'admins', 'uses'=> 'AdminController@admins']) ;

    //test
    Route::get('/test', ['as' => 'test', 'uses'=> 'AdminController@showTestMessage']);
});


