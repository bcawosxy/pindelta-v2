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
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/admin/about', function () {
    return view('admin.about');
});