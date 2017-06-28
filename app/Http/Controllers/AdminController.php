<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use App\Model\About;
use App\Model\Admin;
use App\Model\Category;
use App\Model\Categoryarea;
use App\Model\Contact;
use App\Model\Inquiry;
use App\Model\Sociallink;
use App\Model\Product;
use App\Model\System;
use App\Model\Viewed;
use Illuminate\Http\Request;
use App\Library\UploadHandler;
use Illuminate\Routing\Route;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminlogin', ['except' => ['logout']]);
    }

    public function about()
    {
        $data = [];
        $about = About::where('category', 'about_c')
                    ->select('about.*', 'admin.name as admin_name')
                    ->leftJoin('admin', 'about.modify_id', '=', 'admin.id')
                    ->first();

        if($about) {
            $data = [
                'value' => ($about->value) ? $about->value : null,
                'updated_at' => ($about->updated_at) ? $about->updated_at : null,
                'modify_name' => ($about->admin_name) ? $about->admin_name : null,
            ];
        }

        return view('admin.about', ['data' => $data]);
    }

    public function aboutEdit(Request $request) {
        $user = Auth::user();

        if(About::where('category', 'about_c')->update(['value'=>$request->value, 'modify_id'=>$user->id])) {
            $result = 1;
            $message = '修改完成';
        } else {
            $result = 0;
            $message = '修改失敗, 請重新操作';
        }
        $redirect =  url()->route('admin::about');

        return json_encode_return($result, $message, $redirect );
    }

    public function admins()
    {
		$data = [];
		$e_admin = Admin::get();

		if($e_admin) {
			foreach ($e_admin as $k0 => $v0) {
				$data[] = [
					'id' => $v0->id,
					'account' => $v0->account,
					'name' => $v0->name,
					'email' => $v0->email,
					'ip' => $v0->ip,
					'updated_at' => $v0->updated_at,
				];
			}
		}

		return view('admin.admins', ['data' => $data]);
    }

	public function adminsEdit(Request $request)
	{

		$data = json_decode($request->data, true);

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;
		$passwordEdit = false;

		foreach ($data as $k0 => $v0) {
			$tmp = [
				'account' => $v0['account'],
				'name' => $v0['name'],
				'email' => $v0['email'],
			];

			if($v0['password']) {
				$tmp['password'] = Hash::make($v0['password']);
				$passwordEdit = true;
			}

			if(!Admin::where('id', $v0['id'])->update($tmp)) {
				return json_encode_return($result, $message, $redirect );
			}
		}


		$result = 1;
		$message = ($passwordEdit) ? '修改資料完成, 下次登入時請使用新密碼登入' : '修改資料完成';
		$redirect = url()->route('admin::admins');

		return json_encode_return($result, $message, $redirect);
    }

    public function categoryarea()
    {
        $data = [];
        $categoryarea = Categoryarea::where('status', '!=', 'delete')->orderBy('updated_at', 'desc')->get();
        if($categoryarea) {
            foreach ($categoryarea as $k0 => $v0) {
                $data[] = [
                    'id' => $v0->id,
                    'name' => $v0->name,
                    'priority' => $v0->priority,
                    'description' => $v0->description,
                    'status' => get_label($v0->status),
                ];
            }
        }

        return view('admin.categoryarea', ['data' => $data]);
    }

    public function categoryarea_content($id = null)
    {
        $act = (is_null($id)) ? 'add' : 'edit';
        $categoryarea = null;
        if(!is_null($id)) {
            $e_categoryarea = Categoryarea::where('status', '!=', 'delete')
                ->select('categoryarea.*', 'admin.name as admin_name')
                ->where('categoryarea.id', $id)
                ->leftJoin('admin', 'categoryarea.modify_id', '=', 'admin.id')
                ->get();

            foreach ($e_categoryarea as $k0 => $v0) {
                $categoryarea = [
                    'id' => $v0->id,
                    'name' => $v0->name,
                    'priority' => (int)$v0->priority,
                    'description' => $v0->description,
                    'coverUrl' => asset("storage/images/categoryarea/$v0->cover"),
                    'coverName' => $v0->cover,
                    'modify_id' => $v0->modify_id,
                    'status' => $v0->status,
                    'created_at' => $v0->created_at,
                    'updated_at' => $v0->updated_at,
                    'admin_name' => $v0->admin_name,
                ];
            }
        }

        $data = [
          'act' => $act,
          'categoryarea' => $categoryarea,
        ];
        return view('admin.categoryarea_content', ['data' => $data]);
    }

    public function categoryareaDelete(Request $request)
    {
        $id = $request->id;
        $categoryarea = new Categoryarea();
        DB::beginTransaction();
        list($result, $message, $redirect) = $categoryarea->delCategoryarea($id);
        if($result) DB::commit();
        return json_encode_return($result, $message, $redirect );
    }

    public function categoryareaEdit(Request $request)
    {
        $user = Auth::user();
        //要取得的 POST Key
        $postParams = ['id', 'act', 'name', 'priority', 'status', 'description', 'cover', 'cover_state'];
        foreach ($postParams as $v0) { $$v0 = $request->$v0; }
        if($name == '' || $act == '' || $priority == '' || $status == '' || $description == '' || $cover == '' ) return json_encode_return(0, '資料未填寫完成, 請重新操作');

        //若是新上傳的圖要進行搬移
        if($cover_state == 'new') {
            $coverUploadPath = public_path("upload/files/$cover");
            $coverStoragePath  = storage_path("app/public/images/categoryarea/$cover");
            $r_renameCover = rename($coverUploadPath, $coverStoragePath);
            if(!$r_renameCover) return  json_encode_return(0, '圖片處理失敗, 請重新操作', url()->route('admin::categoryarea_content', ['id' => $id]));
        }

        $params = [
            'name'  => $name,
            'priority' => $priority,
            'status' => $status,
            'description' => $description,
            'cover' => $cover,
            'modify_id' => $user->id,
        ];

        $result = 0;
        $message = '錯誤, 請重新操作';
        $redirect = null;

        if($act == 'add') {
            $params['created_at'] = $params['updated_at'] = inserttime();
            if(DB::table('categoryarea')->insert($params)) {
                $result = 1;
                $message = '新增資料完成';
                $redirect = url()->route('admin::categoryarea');
            }
        } else {
            if (Categoryarea::where('id', $id)->update($params)) {
                $result = 1;
                $message = '修改資料完成';
                $redirect = url()->route('admin::categoryarea_content', ['id' => $id]);
            }
        }

        return json_encode_return($result, $message, $redirect );
    }

    public function category()
    {
        $data = [];
        $e_category = Category::where('category.status', '!=', 'delete')
                ->select('category.*', 'categoryarea.name as categoryarea_name')
                ->leftJoin('categoryarea', 'category.categoryarea_id', '=' , 'categoryarea.id')
                ->orderBy('category.updated_at', 'desc')
                ->get();

        if($e_category) {
            foreach ($e_category as $k0 => $v0) {
                $data[] = [
                    'id' => $v0->id,
                    'name' => $v0->name,
                    'categoryarea_id' => $v0->categoryarea_id,
                    'categoryarea_name' => $v0->categoryarea_name,
                    'priority' => $v0->priority,
                    'description' => $v0->description,
                    'cover' => $v0->cover,
                    'modify_name' => $v0->modify_name,
					'status' => get_label($v0->status),
                ];
            }
        }

        return view('admin.category', ['data' => $data]);
    }

    public function category_content($id = null)
    {
        $act = (is_null($id)) ? 'add' : 'edit';
        $a_category = $a_categoryarea =null;
        switch ($act) {
            case 'add' :
                $e_categoryarea = Categoryarea::where('status', 'open')->get();
                if($e_categoryarea) {
                    foreach ($e_categoryarea as $k0 => $v0) {
                        $a_categoryarea[] = [
                            'id' => $v0->id,
                            'name' => $v0->name,
                        ];
                    }
                }
                break;

            case 'edit' :
                $e_category = Category::
                        select('category.*', 'admin.name as admin_name', 'categoryarea.id as categoryarea_id', 'categoryarea.name as categoryarea_name')
                        ->where('category.id', $id)
                        ->leftJoin('categoryarea', 'category.categoryarea_id', '=' , 'categoryarea.id')
                        ->leftJoin('admin', 'category.modify_id', '=', 'admin.id')
                        ->get();

                foreach ($e_category as $k0 => $v0) {
                    $a_category = [
                        'id' => $v0->id,
                        'name' => $v0->name,
                        'categoryarea_id' => $v0->categoryarea_id,
                        'categoryarea_name' => $v0->categoryarea_name,
                        'priority' => (int)$v0->priority,
                        'description' => $v0->description,
                        'coverUrl' => asset("storage/images/category/$v0->cover"),
                        'coverName' => $v0->cover,
                        'modify_id' => $v0->modify_id,
                        'status' => $v0->status,
                        'created_at' => $v0->created_at,
                        'updated_at' => $v0->updated_at,
                        'admin_name' => $v0->admin_name,
                    ];
                }
                break;

            default :
                // handle some error here...
                break;
        }

        $data = [
            'act' => $act,
            'category' => $a_category,
            'categoryarea' => $a_categoryarea,
        ];
        return view('admin.category_content', ['data' => $data]);
    }

    public function categoryDelete(Request $request)
    {
        $id = $request->id;
        $category = new Category();
        DB::beginTransaction();
        list($result, $message, $redirect) = $category->delCategory($id);
        if($result) DB::commit();
        return json_encode_return($result, $message, $redirect);
    }
    
    public function categoryEdit (Request $request)
    {
        $user = Auth::user();
        //要取得的 POST Key
        $postParams = ['id', 'act', 'name', 'categoryarea_id', 'priority', 'status', 'description', 'cover', 'cover_state'];
        foreach ($postParams as $v0) { $$v0 = $request->$v0; }
        if($name == '' || $act == '' || $priority == '' || $status == '' || $description == '' || $cover == '' ) return json_encode_return(0, '資料未填寫完成, 請重新操作');
        if($act == 'add' && !$categoryarea_id) return json_encode_return(0, '資料未填寫完成, 請重新操作[categoryarea_id]');

        //若是新上傳的圖要進行搬移
        if($cover_state == 'new') {
            $coverUploadPath = public_path("upload/files/$cover");
            $coverStoragePath  = storage_path("app/public/images/category/$cover");
            $r_renameCover = rename($coverUploadPath, $coverStoragePath);
            if(!$r_renameCover) return  json_encode_return(0, '圖片處理失敗, 請重新操作', url()->route('admin::category_content', ['id' => $id]));
        }

        $params = [
            'name'  => $name,
            'priority' => $priority,
            'status' => $status,
            'description' => $description,
            'cover' => $cover,
            'modify_id' => $user->id,
        ];

        $result = 0;
        $message = '錯誤, 請重新操作';
        $redirect = null;

        if($act == 'add') {
            $params['created_at'] = $params['updated_at'] = inserttime();
            $params['categoryarea_id'] = $categoryarea_id ;
            if(DB::table('category')->insert($params)) {
                $result = 1;
                $message = '新增資料完成';
                $redirect = url()->route('admin::category');
            }
        } else {
            if (Category::where('id', $id)->update($params)) {
                $result = 1;
                $message = '修改資料完成';
                $redirect = url()->route('admin::category_content', ['id' => $id]);
            }
        }

        return json_encode_return($result, $message, $redirect);
    }

    public function contact()
    {
		$data = [];
		$e_contact = Contact::where('contact.status', '!=', 'delete')
			->select('contact.*')
			->orderBy('contact.updated_at', 'desc')
			->get();

		$data = [
			'open' => [],
			'archive' => [],
		];

		if($e_contact) {
			foreach ($e_contact as $k0 => $v0) {
				switch ($v0->status) {
					case 'archive' :
						$data['archive'][] = [
							'id' => $v0->id,
							'first_name' => $v0->first_name,
							'last_name' => $v0->last_name,
							'email' => $v0->email,
							'tel' => $v0->tel,
							'read' => get_label($v0->read),
							'status' => get_label($v0->status),
						];
						break;

					case 'open' :
						$data['open'][] = [
							'id' => $v0->id,
							'first_name' => $v0->first_name,
							'last_name' => $v0->last_name,
							'email' => $v0->email,
							'tel' => $v0->tel,
							'read' => get_label($v0->read),
							'status' => get_label($v0->status),
						];
						break;
				}

			}
		}

		return view('admin.contact', ['data' => $data]);
    }

    public function contact_content($id = null)
    {
		$user = Auth::user();
    	$e_contact = Contact::where('contact.id', $id)
			->select('contact.*', 'admin.name as admin_name')
			->leftJoin('admin', 'contact.reader', '=' , 'admin.id')
			->get();
		foreach ($e_contact as $k0 => $v0) {
			$a_contact = [
				'id' => $v0->id,
				'first_name' => $v0->first_name,
				'last_name' => $v0->last_name,
				'company' => $v0->company,
				'tel' => $v0->tel,
				'fax' => $v0->fax,
				'address' => $v0->address,
				'email' => $v0->email,
				'memo' => $v0->memo,
				'status' => $v0->status,
				'status_text' => get_label($v0->status),
				'read' => $v0->read,
				'reader' => $v0->reader,
				'reader_name' => $v0->admin_name,
				'read_time' => $v0->read_time,
				'ip' => $v0->ip,
				'created_at' => $v0->created_at,
			];
		}

		//若該則留言還在未讀取過的狀態, 則同步更新讀取的相關資料
		if( $a_contact['read'] == 'unread') {
			$params = [
				'read' => 'read',
				'reader' => $user->id,
				'read_time' => inserttime(),
			];

			Contact::where('id', $id)->update($params);
		}


		$data = [
			'contact' => $a_contact,
		];
        return view('admin.contact_content', ['data' => $data]);
    }

	public function contactDelete(Request $request)
	{
		$id = $request->id;

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;

		$params = [
			'status' => 'delete',
		];

		if(Contact::where('id', $id)->update($params)) {
			$result = 1;
			$message = '刪除資料完成';
			$redirect = url()->route('admin::contact', ['id' => $id]);
		}

		return json_encode_return($result, $message, $redirect);
	}

	public function contactEdit (Request $request)
	{
		$id = $request->id;

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;

		$params = [
			'status' => 'archive',
		];

		if(Contact::where('id', $id)->update($params)) {
			$result = 1;
			$message = '封存完成。';
			$redirect = url()->route('admin::contact', ['id' => $id]);
		}

		return json_encode_return($result, $message, $redirect);
    }
    
    public function fileUpload()
    {
        $options = array(
            // This option will disable creating thumbnail images and will not create that extra folder.
            // However, due to this, the images preview will not be displayed after upload
            'image_versions' => [],
        );
        $upload = new UploadHandler($options);
    }

    public function index()
    {
		/**
		 * 圖表一 : 逐周的量表
		 */
		//本周最後一天(星期日)
		$this_week = date('Y-m-d', strtotime('+7 day', time()-86400*date('w')));
		$series_line = []; $rate = 7;
		for($i=1; $i<13; $i = $i+1) {$tmp[] = date('Y-m-d 23:59:59', strtotime('-'.($i*$rate).' day', strtotime($this_week)));}
		array_unshift($tmp,$this_week);
		$week = array_reverse($tmp);

		foreach ($week as $k0 => $v0) {
			// Categoryarea
			$c_categoryarea = Categoryarea::where([['status', '!=', 'delete'], ['created_at', '<', $v0]])->orWhere([['status', '=', 'delete'], ['updated_at', '>', $v0]])->count();
			$data_categoryarea[] = $c_categoryarea;

			// Category
			$c_category = Category::where([['status', '!=', 'delete'], ['created_at', '<', $v0]])->orWhere([['status', '=', 'delete'], ['updated_at', '>', $v0]])->count();
			$data_category[] = $c_category;

			// Product
			$c_product = Product::where([['status', '!=', 'delete'], ['created_at', '<', $v0]])->orWhere([['status', '=', 'delete'], ['updated_at', '>', $v0]])->count();
			$data_product[] = $c_product;

			// Viewed
			//從上周至本周($v0)的vieded統計,第一周沒有基準參考值,故用data -7 處理
			$start_day = ($k0 == 0) ? date('Y-m-d', strtotime('-7 day', strtotime($v0))) : date('Y-m-d', strtotime($week[($k0-1)])) ;
			$end_day = date('Y-m-d',strtotime('-1 day' ,strtotime($v0)));

			$c_viewed = DB::table('viewed')->whereBetween('date', [$start_day, $end_day])->SUM('count');
			$data_viwed[] = $c_viewed;

			$chart_categories[] = '\'~'.date('m/d', strtotime($v0)).'\'';
		}

		$series_line = [
			['name'=>'Categoryarea', 'data'=>implode(',', $data_categoryarea)],
			['name'=>'Category', 'data'=>implode(',' ,$data_category)],
			['name'=>'Product', 'data'=>implode(',' ,$data_product)],
		];

		/**
		 * 圖表二 : 各類別下項目及產品數量
		 */
		$series_pie = [];

		$e_categoryarea = Categoryarea::select('categoryarea.id as categoryarea_id', 'categoryarea.name as categoryarea_name', 'category.id as category_id')
										->where([['category.id', '!=', '""'], ['categoryarea.status', '!=', 'delete'], ['category.status', '!=', 'delete']])
										->leftJoin('category', 'category.categoryarea_id', '=' , 'categoryarea.id')
										->groupBy('categoryarea_id')->get();
		$a_categoryarea = json_decode($e_categoryarea, true);

		//所有的categoryarea_id
		foreach ($a_categoryarea as $k0 => $v0) {
			$pie_data = [];
			$prodcut_num = 0;

			$e_category = Category::select('category.name as category_name', DB::raw('COUNT(category_id) as y'))
				->where([['product.id', '!=', '""'], ['category.categoryarea_id', '=', $v0['categoryarea_id']], ['category.status', '!=', 'delete'], ['product.status', '!=', 'delete']])
				->leftJoin('product', 'product.category_id', '=' , 'category.id')
				->groupBy('category_id')->get();

			foreach (json_decode($e_category, true) as $k1 => $v1) {
				$pie_data[] = '{name:"' . $v1['category_name'] . '", y:' . $v1['y'] . '},';
				$prodcut_num += $v1['y'];
			};

			if(count($pie_data) == 0) continue;
			$series_pie[] = [
				'categoryarea_id' => $v0['categoryarea_id'],
				'categoryarea_name' => $v0['categoryarea_name'],
				'category_num' => count($pie_data),
				'product_num' => $prodcut_num,
				'data' => implode('', $pie_data),
			];
		}

		$data = [
			'chart_categories' => $chart_categories,
			'data_viwed'  => $data_viwed,
			'series_line' => $series_line,
			'series_pie' => $series_pie,
		];

        return view('admin.index', ['data' => $data]);
    }

    public function inquiry()
    {
		$e_inquiry = Inquiry::select('inquiry.*', 'product.name')
			->where('inquiry.status', '!=', 'delete')
			->leftjoin('product', 'inquiry.product_id', '=', 'product.id')
			->orderBy('inquiry.updated_at', 'desc')
			->get();

		$data = [
			'open' => [],
			'archive' => [],
		];

		if($e_inquiry) {
			foreach ($e_inquiry as $k0 => $v0) {
				switch ($v0->status) {
					case 'archive' :
						$data['archive'][] = [
							'id' => $v0->id,
							'first_name' => $v0->first_name,
							'last_name' => $v0->last_name,
							'email' => $v0->email,
							'country' => $v0->country,
							'company' => $v0->company,
							'weblink' => $v0->weblink,
							'read' => get_label($v0->read),
							'status' => get_label($v0->status),
							'product_id' => $v0->product_id,
							'product_name' => $v0->name,
						];
						break;

					case 'open' :
						$data['open'][] = [
							'id' => $v0->id,
							'first_name' => $v0->first_name,
							'last_name' => $v0->last_name,
							'email' => $v0->email,
							'country' => $v0->country,
							'company' => $v0->company,
							'weblink' => $v0->weblink,
							'read' => get_label($v0->read),
							'status' => get_label($v0->status),
							'product_id' => $v0->product_id,
							'product_name' => $v0->name,
						];
						break;
				}
			}
		}

		return view('admin.inquiry', ['data' => $data]);
    }

    public function inquiry_content($id = null)
    {
		$user = Auth::user();
    	$e_inquiry = Inquiry::select('inquiry.*', 'admin.name as admin_name', 'product.name as product_name')
			->where('inquiry.id', $id)
			->leftJoin('admin', 'inquiry.reader', '=' , 'admin.id')
			->leftJoin('product', 'inquiry.product_id', '=' , 'product.id')
			->get();

		foreach ($e_inquiry as $k0 => $v0) {
			$a_inquiry = [
				'id' => $v0->id,
				'product_id' => $v0->product_id,
				'product_name' => $v0->product_name,
				'first_name' => $v0->first_name,
				'last_name' => $v0->last_name,
				'email' => $v0->email,
				'quantity' => $v0->quantity,
				'country' => $v0->country,
				'company' => $v0->company,
				'weblink' => $v0->weblink,
				'demand' => $v0->demand,
				'memo' => $v0->memo,
				'status' => $v0->status,
				'status_text' => get_label($v0->status),
				'read' => $v0->read,
				'reader' => $v0->reader,
				'reader_name' => $v0->admin_name,
				'read_time' => $v0->read_time,
				'ip' => $v0->ip,
				'created_at' => $v0->created_at,
			];
		}

		//若該則留言還在未讀取過的狀態, 則同步更新讀取的相關資料
		if( $a_inquiry['read'] == 'unread') {
			$params = [
				'read' => 'read',
				'reader' => $user->id,
				'read_time' => inserttime(),
			];

			Inquiry::where('id', $id)->update($params);
		}

		$data = [
			'inquiry' => $a_inquiry,
		];
    	return view('admin.inquiry_content', ['data' => $data]);
    }

	public function inquiryEdit(Request $request)
	{
		$id = $request->id;

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;

		$params = [
			'status' => 'archive',
		];

		if(Inquiry::where('id', $id)->update($params)) {
			$result = 1;
			$message = '封存完成。';
			$redirect = url()->route('admin::inquiry', ['id' => $id]);
		}

		return json_encode_return($result, $message, $redirect);
    }

	public function inquiryDelete(Request $request)
	{
		$id = $request->id;

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;

		$params = [
			'status' => 'delete',
		];

		if(Inquiry::where('id', $id)->update($params)) {
			$result = 1;
			$message = '刪除資料完成';
			$redirect = url()->route('admin::inquiry', ['id' => $id]);
		}

		return json_encode_return($result, $message, $redirect);
	}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('pindelta::login');
    }

    public function product()
    {
        $data = [];
        $e_product = Product::where('product.status', '!=', 'delete')
            ->select('product.*', 'category.name as category_name')
            ->leftJoin('category', 'product.category_id', '=' , 'category.id')
            ->orderBy('category.updated_at', 'desc')
            ->get();

        if($e_product) {
            foreach ($e_product as $k0 => $v0) {
                $data[] = [
                    'id' => $v0->id,
                    'name' => $v0->name,
                    'category_id' => $v0->category_id,
                    'category_name' => $v0->category_name,
                    'priority' => $v0->priority,
                    'description' => $v0->description,
					'status' => get_label($v0->status),
                ];
            }
        }
        return view('admin.product', ['data' => $data]);
    }

    public function product_content($id = null)
    {
        $act = (is_null($id)) ? 'add' : 'edit';
        $a_product = $a_category = null;
        switch ($act) {
            case 'add' :
                $e_category = Category::where('status', 'open')->get();
                if($e_category) {
                    foreach ($e_category as $k0 => $v0) {
                        $a_category[] = [
                            'id' => $v0->id,
                            'name' => $v0->name,
                        ];
                    }
                }
                break;

            case 'edit' :
                $e_product = Product::
                select('product.*', 'admin.name as admin_name', 'category.id as category_id', 'category.name as category_name')
                    ->where('product.id', $id)
                    ->leftJoin('category', 'product.category_id', '=' , 'category.id')
                    ->leftJoin('admin', 'product.modify_id', '=', 'admin.id')
                    ->get();

                foreach ($e_product as $k0 => $v0) {
                    $a_product = [
                        'id' => $v0->id,
                        'name' => $v0->name,
                        'category_id' => $v0->category_id,
                        'category_name' => $v0->category_name,
                        'priority' => (int)$v0->priority,
                        'description' => $v0->description,
                        'content' => $v0->content,
                        'model' => $v0->model,
                        'standard' => $v0->standard,
                        'material' => $v0->material,
                        'produce_time' => $v0->produce_time,
                        'lowest' => $v0->lowest,
                        'memo' => $v0->memo,
                        'tags' => json_decode( $v0->tags, true ),
                        'coverUrl' => asset("storage/images/product/$v0->cover"),
                        'coverName' => $v0->cover,
                        'modify_id' => $v0->modify_id,
                        'status' => $v0->status,
                        'created_at' => $v0->created_at,
                        'updated_at' => $v0->updated_at,
                        'admin_name' => $v0->admin_name,
                    ];
                }
                break;

            default :
                // handle some error here...
                break;
        }

        $data = [
            'act' => $act,
            'product' => $a_product,
            'category' => $a_category,
        ];

        return view('admin.product_content', ['data' => $data]);
    }

    public function productDelete (Request $request)
    {
        $id = $request->id;
        $product = new Product();
        DB::beginTransaction();
        list($result, $message, $redirect) = $product->delProduct($id);
        if($result) DB::commit();
        return json_encode_return($result, $message, $redirect);
    }
    
    public function productEdit(Request $request)
    {
        $user = Auth::user();
        //要取得的 POST Key
        $postParams = ['id', 'act', 'name', 'category_id', 'priority', 'model', 'standard', 'material', 'produce_time', 'lowest', 'memo', 'content', 'status', 'description', 'cover', 'cover_state', 'tags'];
        foreach ($postParams as $v0) { $$v0 = $request->$v0; }
        if($name == '' || $priority == '' || $model == '' || $material == '' || $produce_time == '' || $status == '' || $description == '' || $cover == '' ) return json_encode_return(0, '資料未填寫完成, 請重新操作');
        if($act == 'add' && !$category_id) return json_encode_return(0, '資料未填寫完成, 請重新操作[category_id]');

        //若是新上傳的圖要進行搬移
        if($cover_state == 'new') {
            $coverUploadPath = public_path("upload/files/$cover");
            $coverStoragePath  = storage_path("app/public/images/product/$cover");
            $r_renameCover = rename($coverUploadPath, $coverStoragePath);
            if(!$r_renameCover) return  json_encode_return(0, '圖片處理失敗, 請重新操作', url()->route('admin::product_content', ['id' => $id]));
        }

        $params = [
            'name'  => $name,
            'priority' => $priority,
            'model' => $model,
            'standard' => $standard,
            'material' => $material,
            'produce_time' => $produce_time,
            'lowest' => $lowest,
            'memo' => $memo,
            'content' => $content,
            'status' => $status,
            'description' => $description,
            'cover' => $cover,
            'modify_id' => $user->id,
            'tags' => json_encode($tags),
        ];
        $result = 0;
        $message = '錯誤, 請重新操作';
        $redirect = null;

        if($act == 'add') {
            $params['created_at'] = $params['updated_at'] = inserttime();
            $params['category_id'] = $category_id ;
            if(DB::table('product')->insert($params)) {
                $result = 1;
                $message = '新增資料完成';
                $redirect = url()->route('admin::product');
            }
        } else {
            if (Product::where('id', $id)->update($params)) {
                $result = 1;
                $message = '修改資料完成';
                $redirect = url()->route('admin::product_content', ['id' => $id]);
            }
        }

        return json_encode_return($result, $message, $redirect );
    }

    public function sociallink()
    {
        $data = [];
        $e_sociallink = Sociallink::where('sociallink.status', '!=', 'delete')
            ->orderBy('sociallink.id', 'asc')
            ->get();

        if($e_sociallink) {
            foreach ($e_sociallink as $k0 => $v0) {
                $data[] = [
                    'id' => $v0->id,
                    'name' => $v0->name,
                    'url' => $v0->url,
                    'status' => $v0->status,
                    'priority' => $v0->priority,
                    'updated_at' => $v0->updated_at,
                ];
            }
        }

        $a_icon = ['fa-google', 'fa-facebook', 'fa-flickr', 'fa-twitter', 'fa-google', 'fa-instagram', 'fa-linkedin', 'fa-pinterest', 'fa-tumblr'];

        return view('admin.sociallink', ['data' => $data, 'icon' => $a_icon]);
    }

    public function sociallinkEdit(Request $request)
    {
        $data = json_decode($request->data, true);

        foreach($data as $k0 => $v0) {
            if( !is_url($v0[1]) ) return json_encode_return(0, '"'.$v0[1].'" 不是正確的URL格式, 請重新輸入');

            $params = [
                'url' => $v0[1],
                'priority' => $v0[2],
                'status' => $v0[3],
            ];

            if(!Sociallink::where('id', $v0[0])->update($params)) {
                return json_encode_return(0, '更新資料失敗, 請重新操作');
            }
        }

        return json_encode_return(1, '更新資料完成。', url()->route('admin::sociallink'));
    }

    public function system()
    {
		$data = [];
		$e_system = System::get();

		if($e_system) {
			$data = json_decode($e_system[0], true);
			$data['social'] = [
				'skin' => [
					'birman' => ($data['social_skin'] == 'birman') ? 'checked="true"' : null,
					'classic' => ($data['social_skin'] == 'classic') ? 'checked="true"' : null,
					'flat' => ($data['social_skin'] == 'flat') ? 'checked="true"' : null,
				],
				'look' => [
					'horizontal' => ($data['social_look'] == 'horizontal') ? 'checked="true"' : null,
					'single' => ($data['social_look'] == 'single') ? 'checked="true"' : null,
				],
			];
		}

    	return view('admin.system', ['data' => $data]);
    }

	public function systemEdit(Request $request)
	{
		//要取得的 POST Key
		$postParams = ['web_title', 'web_description', 'office_info_phone', 'office_info_email', 'r1', 'r2', 'r3'];
		foreach ($postParams as $v0) { $$v0 = $request->$v0; }

		$params = [
			'web_title'  => $web_title,
			'web_description' => $web_description,
			'office_info_phone' => $office_info_phone,
			'office_info_email' => $office_info_email,
			'social_look' => $r1,
			'social_skin' => $r2,
			'maintain' => ($r3=='open') ? 1 : 0,
		];

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;

		if(System::where('id', 1)->update($params)) {
			$result = 1;
			$message = '更新資料完成。';
			$redirect = url()->route('admin::system');
		}

		return json_encode_return($result, $message, $redirect );

	}

	public function test(Request $request)
	{
//		return response('')->withCookie(cookie('name', 'my value', 60));
		setcookie('name', null, -1, '/');
		echo ($request->cookie('name')) ? 1 : 2;
//		echo $value;
	}
}
