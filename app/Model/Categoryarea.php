<?php

namespace App\Model;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Categoryarea extends Model
{
    protected $table = 'categoryarea';

    /**
     *  刪除單筆類別
     * @param $id
     * @return array
     */
    public function delCategoryarea($id)
    {
        $user = Auth::user();
        $redirect = url()->route('admin::categoryarea');
        //要先找出底下的項目id列表並刪除
        $categorys = DB::table('category')->where([['categoryarea_id', $id], ['status', '!=' , 'delete']])->pluck('id')->all();
        if($categorys) {
            $category = new Category();
            list($result, $message) = $category->delCategorys($categorys);
            if(!$result) goto _return;
        }

        try {
            $this->where('id', $id)->update(['status' => 'delete', 'modify_id'=>$user->id]);

            $result = 1;
            $message = '刪除資料完成';
        }
        catch (\Exception $e) {
            //捕捉錯誤訊息 : $e->getMessage();
            $result = 0;
            $message = '刪除失敗, 請重新操作或聯絡系統管理員[Categoryarea]';
            DB::rollback();
        }

        _return:
        return [$result, $message, $redirect];
    }

    public function getCategoryarea($page	) {
		$unit = 10;
		$num = ($page-1)*$unit;

    	$e_categoryarea = Categoryarea::select(DB::raw('DISTINCT(categoryarea.id) as categoryarea_id'), 'categoryarea.cover', 'categoryarea.name', 'categoryarea.description')
			->where([['category.status','open'], ['categoryarea.status','open']])
			->leftJoin('category', 'category.categoryarea_id', '=' , 'categoryarea.id')
			->groupBy('categoryarea.id')
			->skip($num)->take($unit)
			->get();

    	return $e_categoryarea;
	}
}
