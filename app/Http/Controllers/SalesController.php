<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Products;

class SalesController extends Controller
{

 # 投稿作成
 public function create(Request $request)
 {
    $sales = new Sales();
    $product_id = $request->input('product_id');
    $sales->product_id = $product_id;/* リクエストされたIDを変数に代入する */

    $products = Products::find($product_id);/* productsテーブルからidを検索 */

    if($products->stock <= 0){
        trigger_error("対象レコードの在庫がありません",E_USER_ERROR);
    }

    $products->decrement('stock');/* 該当IDのストックを1減らす */

    $sales->created_at = now();/* 作成日時 */
    $sales->updated_at = now();/* 更新日時 */

    /* 保存する */
    $sales->save();


    return response()->json(Sales::all());/* 結果を返す */
 }

 
}