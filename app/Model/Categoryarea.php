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
	 * @return Array
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

	/**
	 *  取得一筆 Categoryarea
	 * @param $id
	 * @return Array
	 */
    public function getCategoryarea($id)
	{
		$e_categoryarea = Categoryarea::where([['categoryarea.status','open'], ['categoryarea.id', $id]])->first();
		return json_decode($e_categoryarea, true);
	}

	/**
	 *  取得多筆 Categoryarea (首頁瀑布流)
	 * @param $page
	 * @return Array
	 */
	public function getCategoryareas($page) {
		$unit = 10;
		$num = ($page-1)*$unit;

    	$e_categoryarea = Categoryarea::select(DB::raw('DISTINCT(categoryarea.id) as categoryarea_id'), 'categoryarea.cover', 'categoryarea.name', 'categoryarea.description')
			->where([['category.status','open'], ['categoryarea.status','open'], ['product.status', 'open']])
			->leftJoin('category', 'category.categoryarea_id', '=' , 'categoryarea.id')
			->leftJoin('product', 'category.id', '=' , 'product.category_id')
			->groupBy('categoryarea.id')
			->orderBy('categoryarea.priority', 'ASC')
            ->skip($num)->take($unit)
			->get();

    	return $e_categoryarea;
	}
}
