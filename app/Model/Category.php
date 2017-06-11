<?php

namespace App\Model;

use Auth;
use DB;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function delCategory($id)
    {
        $user = Auth::user();
        $result0 = true;
        //要先找出底下的產品id列表並刪除
        $products = DB::table('product')->where([['category_id', $id], ['status', '!=' , 'delete']])->pluck('id')->all();
        if($products) {
            $product = new Product();
            $result0 = $product->delProducts($products);
        }

        if($result0) {
            $result1 = $this->where('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);
            $return = ($result1) ? [1, '刪除資料完成', url()->route('admin::category')] : [0, '刪除失敗, 請重新操作[Category]', url()->route('admin::category')];
        } else {
            $return = [0, '刪除失敗, 請重新操作[Product]', url()->route('admin::category')];
        }

        return $return;
    }

    public function delCategorys(array $id)
    {
        $user = Auth::user();
        //要先找出底下的產品id列表並刪除
        $products = DB::table('product')->whereIn('category_id', $id)->where('status', '!=', 'delete')->pluck('id')->all();
        if($products) {
            $product = new Product();
            $result = $product->delProducts($products);
            if(!$result) return $result; //產品刪除失敗
        }

        $return = $this->whereIn('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);
        return $return;
    }
}
