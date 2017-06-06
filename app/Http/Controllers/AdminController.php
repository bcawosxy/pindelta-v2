<?php

namespace App\Http\Controllers;

use Auth;
use App\About;
use App\Categoryarea;
use Illuminate\Http\Request;

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
        $result = About::where('category', 'about_c')->update(['value'=>$request->value, 'modify_id'=>$user->id]);

        if($result) {
            $status = 200;
            $content = ['message' => '修改完成', 'redirect' => url()->route('admin::about')];
        } else {
            $status = 401;
            $content = ['status'=> 0,  'message' => '修改失敗，請重新操作。', 'redirect' => url()->route('admin::about')];
        }

        return response($content, $status)->header('Content-Type', 'application/json');
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
                    'cover' => $v0->cover,
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

    public function categoryareaEdit(Request $request)
    {
        $user = Auth::user();
        $id = $request->id;
        $act = $request->act;
        $name = $request->name;
        $priority = $request->priority;
        $status = $request->status;
        $description = $request->description;

        $edit = [
            'name'  => $name,
            'priority' => $priority,
            'status' => $status,
            'description' => $description,
            'modify_id' => $user->id,
        ];

        if($act == 'add') {

        } else {
            $result = Categoryarea::where('id', $id)->update($edit);
        }

        if($result) {
            $status = 200;
            $content = ['message' => '修改完成', 'redirect' => url()->route('admin::categoryarea_content', ['id' => $id])];
        } else {
            $status = 401;
            $content = ['status'=> 0, 'message' => '修改失敗，請重新操作。', 'redirect' => url()->route('admin::categoryarea_content', ['id'=>$id])];
        }


        return response($content, $status)->header('Content-Type', 'application/json');
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

    public function fileUpload( )
    {
        $return = null;
        $FmyFunctions1 = new \App\Library\UploadHandler;
        return  $return;
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
