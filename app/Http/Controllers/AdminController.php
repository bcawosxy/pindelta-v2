<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('test', ['except' => ['showTestMessage']]);
    }

    public function showTestMessage() {
        return 'This is Test Page : '.route('admin::test');
    }

    public function about()
    {
        return view('admin.about');
    }

    public function admins()
    {
        return view('admin.admins');
    }

    public function categoryarea()
    {
        return view('admin.categoryarea');
    }

    public function categoryarea_edit()
    {
        return view('admin.categoryarea_edit');
    }

    public function category()
    {
        return view('admin.category');
    }

    public function category_edit()
    {
        return view('admin.category_edit');
    }

    public function contact()
    {
        return view('admin.contact');
    }

    public function contact_edit()
    {
        return view('admin.contact_edit');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function inquiry()
    {
        return view('admin.inquiry');
    }

    public function inquiry_edit()
    {
        return view('admin.inquiry_edit');
    }

    public function product()
    {
        return view('admin.product');
    }

    public function product_edit()
    {
        return view('admin.product_edit');
    }

    public function sociallink()
    {
        return view('admin.sociallink');
    }

    public function system()
    {
        return view('admin.system');
    }

}
