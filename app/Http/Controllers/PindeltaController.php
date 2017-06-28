<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\About;
use App\Model\Admin;
use App\Model\Viewed;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PindeltaController extends Controller
{
	public function __construct(Request $request)
	{
		/**
		 *  紀錄訪客訪問前台次數
		 *  2016-07-02 記錄IP
		 *  2017-06-27 調整為Laravel方式處理
		 */
		set_ip_log();
		$tmp0 = md5('pindelta.com');
		if (!$request->cookie('viewed')) {
			$e_viewed = Viewed::where('date', date("Y-m-d"))->first();
			$viewed = json_decode($e_viewed, true);
			if ($viewed) {
				Viewed::where('date', date("Y-m-d"))->update(['count' => $viewed['count']+1]);
			} else {
				Viewed::insert(['date' =>  date("Y-m-d"),'count' => 1]);
			}

			setcookie('viewed', $tmp0, time() + 86400, '/');
		}
	}

	public function about()
	{
		$data = [];
		$about = About::where('category', 'about_c')->first();

		$data = [
			'value' => ($about->value) ? $about->value : null,
		];

		return view('about', ['data' => $data]);
	}

	public function contact()
	{
		return view('contact');
	}

	public function index()
	{
		return view('index');
	}
	
    public function login(Request $request)
    {
        if (Auth::attempt(['account' => $request->account, 'password' => $request->password])) {
            //登入完成 進入後台

			$user = Auth::user();
			$param = [
				'ip' => $request->ip(),
			];

			Admin::where('id', $user->id)->update($param);

            return redirect()->route('admin::index');
        } else {
            //登入失敗 回到登入頁
            return redirect()->route('pindelta::login')->withErrors(['msg'=>'帳號或密碼錯誤, 請重新登入。']);
        }
    }

    public function ShowLoginPage()
    {
        if(!Auth::check()) {
            return view('login');
        } else {
            return redirect()->route('admin::index');
        }
    }
}
