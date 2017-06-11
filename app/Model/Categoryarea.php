<?php

namespace App\Model;

use Auth;
use DB;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Categoryarea extends Model
{
    protected $table = 'categoryarea';

    public function delCategoryarea($id)
    {
        $user = Auth::user();
        $result0 = true;

        //要先找出底下的項目id列表並刪除
        $categorys = DB::table('category')->where([['categoryarea_id', $id], ['status', '!=' , 'delete']])->pluck('id')->all();
        if($categorys) {
            $category = new Category();
            $result0 = $category->delCategorys($categorys);
        }

        if($result0) {
            $result1 = $this->where('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);
            $return = ($result1) ? [1, '刪除資料完成', url()->route('admin::categoryarea')] : [0, '刪除失敗, 請重新操作[Category]', url()->route('admin::categoryarea')];
        } else {
            $return = [0, '刪除失敗, 請重新操作[Product]', url()->route('admin::categoryarea')];
        }

        return $return;
    }
}
