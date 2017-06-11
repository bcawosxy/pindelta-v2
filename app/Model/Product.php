<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    /**
     * 刪除單筆產品
     * @param $id
     * @return array
     */
    public function delProduct($id)
    {
        $user = Auth::user();
        $result = $this->where('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);
        $return = ($result) ? [1, '刪除資料完成', url()->route('admin::product')] : [0, '刪除失敗, 請重新操作', url()->route('admin::product')];

        return $return;
    }

    /**
     * 刪除多筆產品
     * @param array $id
     * @return boolean
     */
    public function delProducts(array $id)
    {
        $user = Auth::user();
        $result = $this->whereIn('id', $id)->update(['status'=>'delete', 'modify_id'=>$user->id]);
        return $result;
    }
}
