<?php

namespace App\Model;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    /**
     *  刪除單筆項目
     *  @param $id
     *  @return array
     */
    public function delCategory($id)
    {
        $user = Auth::user();
        $redirect = url()->route('admin::category');
        //要先找出底下的產品id列表並刪除
        $products = DB::table('product')->where([['category_id', $id], ['status', '!=' , 'delete']])->pluck('id')->all();
        if($products) {
            $product = new Product();
            list($result, $message) = $product->delProducts($products);
            if(!$result) goto _return;
        }

        try {
            $this->where('id', $id)->update(['status' => 'delete', 'modify_id' => $user->id]);

            $result = 1;
            $message = '刪除資料完成';
        }
        catch (\Exception $e) {
            //捕捉錯誤訊息 : $e->getMessage();
            $result = 0;
            $message = '刪除失敗, 請重新操作或聯絡系統管理員[Category]';
            DB::rollback();
        }

        _return:
        return [$result, $message, $redirect];
    }

    /**
     * 刪除多筆項目
     * @param array $id
     * @return array
     */
    public function delCategorys(array $id)
    {
        $user = Auth::user();
        $redirect = url()->route('admin::category');
        //要先找出底下的產品id列表並刪除
        $products = DB::table('product')->whereIn('category_id', $id)->where('status', '!=', 'delete')->pluck('id')->all();
        if($products) {
            $product = new Product();
            list($result, $message) = $product->delProducts($products);
            if(!$result) goto _return;
        }

        try {
            $this->whereIn('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);

            $result = 1;
            $message = '刪除資料完成';
        }
        catch (\Exception $e) {
            //捕捉錯誤訊息 : $e->getMessage();
            $result = 0;
            $message = '刪除失敗, 請重新操作或聯絡系統管理員[Category]';
            DB::rollback();
        }

        _return:
        return [$result, $message, $redirect];

    }
}
