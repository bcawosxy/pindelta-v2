<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Model\About;
use App\Model\Category;
use App\Model\Categoryarea;
use App\Model\Product;
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
        return view('admin.admins');
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
                    'status' => $v0->status,
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
        list($result, $message, $redirect) = $categoryarea->delCategoryarea($id);
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
                    'status' => $v0->status,
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
        list($result, $message, $redirect) = $category->delCategory($id);
        return json_encode_return($result, $message, $redirect );
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
        return view('admin.contact');
    }

    public function contact_edit()
    {
        return view('admin.contact_edit');
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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
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
                    'status' => $v0->status,
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
        list($result, $message, $redirect) = $product->delProduct($id);
        return json_encode_return($result, $message, $redirect );
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
        return view('admin.sociallink');
    }

    public function system()
    {
        return view('admin.system');
    }

}
