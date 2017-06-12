<?php

namespace App\Model;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    /**
     *  刪除單筆產品
     *  @param $id
     *  @return array
     */
    public function delProduct($id)
    {
        $user = Auth::user();
        try {
            $this->where('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);
            $return = [1, '刪除資料完成', url()->route('admin::product')];
        }
        catch (\Exception $e) {
            //捕捉錯誤訊息 : $e->getMessage();
            $return = [0, '刪除失敗, 請重新操作或聯絡系統管理員', url()->route('admin::product')];
            DB::rollback();
        }
        return $return;
    }

    /**
     *  刪除多筆產品
     *  @param array $id
     *  @return array
     */
    public function delProducts(array $id)
    {
        $user = Auth::user();
        try {
            $this->whereIn('id', $id)->where('status', '!=', 'delete')->update(['status'=>'delete', 'modify_id'=>$user->id]);
            $return = [1, '刪除資料完成', url()->route('admin::product')];
        }
        catch (\Exception $e) {
            //捕捉錯誤訊息 : $e->getMessage();
            $return = [0, '刪除失敗, 請重新操作或聯絡系統管理員[Products]', url()->route('admin::product')];
            DB::rollback();
        }

        return $return;
    }
}
