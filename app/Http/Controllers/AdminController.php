<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\About;
use App\Categoryarea;
use App\Library\MyFunction;
use Illuminate\Http\Request;
use App\Library\UploadHandler;

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

    public function aboutEdit(Request $request, MyFunction $mF) {
        $user = Auth::user();

        if(About::where('category', 'about_c')->update(['value'=>$request->value, 'modify_id'=>$user->id])) {
            $result = 1;
            $message = '修改完成';
        } else {
            $result = 0;
            $message = '修改失敗, 請重新操作';
        }
        $redirect =  url()->route('admin::about');

        return $mF->json_encode_return($result, $message, $redirect );
    }

    public function admins()
    {
        return view('admin.admins');
    }

    public function categoryarea()
    {
        $user = Auth::user();
        $data = [];
        $categoryarea = Categoryarea::where('status', '!=', 'delete')->orderBy('updated_at', 'desc')->get();
        if($categoryarea) {
            foreach ($categoryarea as $k0 => $v0) {
                $data[] = [
                    'id' => $v0->id,
                    'name' => $v0->name,
                    'priority' => $v0->priority,
                    'description' => $v0->description,
                    'cover' => $v0->cover,
                    'modify_name' => $v0->modify_name,
                    'status' => $v0->status,
                    'created_at' => $v0->created_at,
                    'updated_at' => $v0->updated_at->toDateTimeString(),
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

    public function categoryareaEdit(Request $request, MyFunction $mF)
    {
        $user = Auth::user();
        //要取得的 POST Key
        $postParams = ['id', 'act', 'name', 'priority', 'status', 'description', 'cover', 'cover_state'];
        foreach ($postParams as $v0) { $$v0 = $request->$v0; }
        if($name == '' || $act == '' || $priority == '' || $status == '' || $description == '' || $cover == '' ) return $mF->json_encode_return(0, '資料未填寫完成, 請重新操作');

        //若是新上傳的圖要進行搬移
        if($cover_state == 'new') {
            $coverUploadPath = public_path("upload/files/$cover");
            $coverStoragePath  = storage_path("app/public/images/categoryarea/$cover");
            $r_renameCover = rename($coverUploadPath, $coverStoragePath);
            if(!$r_renameCover) return  $mF->json_encode_return(0, '圖片處理失敗, 請重新操作', url()->route('admin::categoryarea_content', ['id' => $id]));
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
            $params['created_at'] = $params['updated_at'] = $mF->inserttime();
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

        return $mF->json_encode_return($result, $message, $redirect );
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

    public function fileUpload(Request $request)
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

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
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
