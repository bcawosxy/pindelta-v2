<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Model\Category;
use App\Model\Categoryarea;
use App\Model\Contact;
use App\Model\System;
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
		set_ip_log($request->ip());
		$tmp0 = md5('pindelta.com');
		if (!$request->cookie('viewed')) {
			$e_viewed = Viewed::where('date', date("Y-m-d"))->first();
			$viewed = json_decode($e_viewed, true);
			if ($viewed) {
				Viewed::where('date', date("Y-m-d"))->update(['count' => $viewed['count'] + 1]);
			} else {
				Viewed::insert(['date' => date("Y-m-d"), 'count' => 1]);
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

	public function categoryarea($id, $page = 1)
	{
		$sidebar = $this->getSideBar();

		$page = 1;
		$unit = 10;
		$num = ($page-1)*$unit;

		$e_category = Category::select('category.id', 'category.cover', 'category.name', 'category.description')
			->where([['category.status','open'], ['category.categoryarea_id', $id]])
			->skip($num)->take($unit)
			->get();

		foreach ($e_category as $k0 => $v0) {
			$a_category[] = [
				'id' => $v0->id,
				'cover' => asset("storage/images/category/$v0->cover"),
				'description' => $v0->description,
				'name' => $v0->name,
				'url' => url()->route('pindelta::categoryarea'),
			];
		}

		$data = [
			'category' => $a_category,
			'sidebar' => $sidebar,
			'activeCategoryarea_id' => $id,
		];
		return view('categoryarea', ['data' => $data]);
	}

	public function contact()
	{
		$e_system = System::first();
		$data = [
			'contact' => json_decode($e_system, true),
		];

		return view('contact', ['data' => $data]);
	}

	public function contactAdd (Request $request)
	{
		$postParams = ['first_name', 'last_name', 'tel', 'fax', 'company', 'email', 'address', 'memo'];
		foreach ($postParams as $v0) { $$v0 = $request->$v0; }
		if($first_name == '' || $last_name == '' || $tel == '' || $email == '' || $memo == '') return json_encode_return(0, '資料未填寫完成, 請重新操作');

		$result = 0;
		$message = 'Error, Try again please!';
		$redirect = url()->route('pindelta::contact');

		$params = [
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'tel' => $tel,
			'memo' =>  $memo,
			'company' => ($company == '') ? '' : $company,
			'fax' => ($fax == '') ? '' : $fax,
			'address' => ($address == '') ? '' : $address,
			'ip' => $request->ip(),
		];

		if(Contact::insert($params)) {
			$result = 1;
			$message = 'Your message has been successfully sent. We will contact you very soon !';
			$redirect = url()->route('pindelta::index');
		}

		return json_encode_return($result, $message, $redirect );
	}

	public function getSideBar()
	{
        //取出側邊選單資料
        $select = [ 'categoryarea.id AS cg_id',
            'categoryarea.name AS cg_name',
            'category.id AS c_id',
            'category.name AS c_name',
            'product.id AS p_id',
            'product.name AS p_name'];
        $e_product = Product::select($select)
            ->leftJoin('category', 'product.category_id', '=' , 'category.id')
            ->leftJoin('categoryarea', 'category.categoryarea_id', '=' , 'categoryarea.id')
            ->where([['categoryarea.status','open'], ['category.status', 'open']])->get();

        $a_product = json_decode($e_product, true);
        $a_categoryarea_id = array_unique( array_column($a_product,'cg_id'));
        $a_category_id = array_unique( array_column($a_product,'c_id'));



        $tmp = [];
        foreach (json_decode($e_categoryarea, true) as $k0 => $v0) {

            if(in_array($v0['categoryarea_id'], $tmp)) continue;
            $sideBar[] = [
                'categoryarea_id' => $v0['categoryarea_id'],
                'categoryarea_name' => $v0['categoryarea_name'],
                'category' => $id[$v0['categoryarea_id']],
            ];

            $tmp[] = $v0['categoryarea_id'];
        }

        $return = $sideBar;
        return $return;
	}

	public function index($page = 1)
	{

		$categoryarea = new Categoryarea();
		$e_categoryarea = $categoryarea->getCategoryarea($page);

		$a_categoryarea = [];

		foreach ($e_categoryarea as $k0 => $v0) {
			$a_categoryarea[] = [
				'id' => $v0->categoryarea_id,
				'cover' => asset("storage/images/categoryarea/$v0->cover"),
				'description' => $v0->description,
				'name' => $v0->name,
				'url' => url()->route('pindelta::categoryarea', ['id'=> $v0->categoryarea_id]),
			];
		}

		$data = [
			'categoryarea' => $a_categoryarea,
		];
		return view('index', ['data' => $data]);
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
			return redirect()->route('pindelta::login')->withErrors(['msg' => '帳號或密碼錯誤, 請重新登入。']);
		}
	}

	public function ShowLoginPage()
	{
		if (!Auth::check()) {
			return view('login');
		} else {
			return redirect()->route('admin::index');
		}
	}
}