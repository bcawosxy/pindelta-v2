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

Route::get('/login', function () {
    return view('login');
});


//admin
Route::group(['prefix'=>'admin'], function() {
    // index  圖表
    Route::get('/', function () {
        return view('admin.index');
    });

    //關於品利興
    Route::get('/about', function () {
        return view('admin.about');
    });

    //產品類別
    Route::get('/categoryarea', function () {
        return view('admin.categoryarea');
    });
    //產品類別管理
    Route::get('/categoryarea/edit', function () {
        return view('admin.categoryarea_edit');
    });

    //產品項目
    Route::get('/category', function () {
        return view('admin.category');
    });
    //產品項目管理
    Route::get('/category/edit', function () {
        return view('admin.category_edit');
    });

    //產品
    Route::get('/product', function () {
        return view('admin.product');
    });
    //產品管理
    Route::get('/product/edit', function () {
        return view('admin.product_edit');
    });

    //社群網站連結
    Route::get('/sociallink', function () {
        return view('admin.sociallink');
    });

    //聯絡我們
    Route::get('/contact', function () {
        return view('admin/contact');
    });
    //聯絡我們管理
    Route::get('/contact/edit', function () {
        return view('admin/contact_edit');
    });

    //產品詢價
    Route::get('/inquiry', function () {
         return view('admin/inquiry');
    });
    //產品詢價管理
    Route::get('/inquiry/edit', function () {
        return view('admin/inquiry_edit');
    });

    //系統參數
    Route::get('/system', function () {
        return view('admin/system');
    });

    //管理員清單
    Route::get('/admins', function () {
        return view('admin/admins');
    });
});


