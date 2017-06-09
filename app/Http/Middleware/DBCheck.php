<?php

namespace App\Http\Middleware;

use App\Model\Category;
use App\Model\Product;
use DB;
use App\Model\Categoryarea;
use Closure;

class DBCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->id;
        $result = 1;

        if(!is_null($id)) {
            $result = 0;
            //透過route name 取得資料表名稱
            $dbName = explode('/', $request->path())[1];
            //目前驗證 categoryarea / category / product
            switch ($dbName) {
                case 'categoryarea' :
                    $result = Categoryarea::where([['status', '!=', 'delete'], ['categoryarea.id', $id]])->count();
                    break;

                case 'category' :
                    $result = Category::where([['status', '!=', 'delete'], ['category.id', $id]])->count();
                    break;

                case 'product' :
                    $result = Product::where([['status', '!=', 'delete'], ['product.id', $id]])->count();
                    break;
            }
        }

        //找不到符合資料
        if(!$result) {
            return redirect('admin/'.$dbName)->withErrors(['msg']);
        } else {
            return $next($request);
        }
    }
}
