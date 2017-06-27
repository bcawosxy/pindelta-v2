<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use App\Model\Category;
use App\Model\Contact;
use App\Model\Inquiry;
use App\Model\Product;
use App\Model\Categoryarea;

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
            //目前驗證 categoryarea / category / product / contact / inquiry
            switch ($dbName) {
                case 'categoryarea' :
                    $result = Categoryarea::where([['status', '!=', 'delete'], ['categoryarea.id', $id]])->count();
                    break;

                case 'category' :
                    $result = Category::where([['status', '!=', 'delete'], ['category.id', $id]])->count();
                    break;

                case 'contact' :
                    $result = Contact::where([['status', '!=', 'delete'], ['contact.id', $id]])->count();
                    break;

                case 'product' :
                    $result = Product::where([['status', '!=', 'delete'], ['product.id', $id]])->count();
                    break;

                case 'inquiry' :
                    $result = Inquiry::where([['status', '!=', 'delete'], ['inquiry.id', $id]])->count();
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
