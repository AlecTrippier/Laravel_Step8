<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    Public function products()
  {
    //  Productsモデルのデータを引っ張てくる
    return $this->hasOne('App\Products');
  }

  public function index_table($request){

    /* テーブルから全てのレコードを取得する */
    $companies = Companies::query();

    $keyword = $request->input('keyword');
    $upper = $request->input('upper');
    $lower = $request->input('lower');


       /* $upper = 2;
       $lower = 3; */
/* キーワードから検索処理 */

    if(!empty($keyword)) {
      $companies->where('company_name', 'LIKE', "%{$keyword}%")
      ->orwhereHas('products', function ($query) use ($keyword) {
          $query->where('product_name', 'LIKE', "%{$keyword}%");
      })->get();
      }
/* 最大値から検索処理 */
    if(!empty($upper)) {

      $companies->whereHas('products', function ($q)use($upper) {
        $q->where('id', '>=',$upper);
          })->get();

        }
/* 最小値から検索処理 */
    if(!empty($lower)) {
      $companies->whereHas('products', function ($q)use($lower) {
        $q->where('id', '<=',$lower);
          })->get();

        }



//解説　https://akizora.tech/laravel-wherehas-4276


    /* ページネーション */
    $posts = $companies->paginate(3);

    return $posts;

  }

  public function companies_save($request,$id){

    $companies = Companies::findOrFail($id);
    $companies->company_name = $request->company_name;
    $companies->street_address = '住所';
    $companies->representative_name = '代表者名';
    $companies->save();

  }

  public function companies_destroy($id){

    $companies = Companies::findOrFail($id);
    $products = Products::findOrFail($id);

    // 削除
    $companies->delete();
    $products->delete();


  }
}
