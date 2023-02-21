<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    public function store_process($request){



        $maxUserId = Products::max('id')+1;

        // ディレクトリ名
        $dir = 'img';


        // ランダムな名前でsampleディレクトリに画像を保存する場合
        // $request->file('image')->store('public/' . $dir);

        // 取得したファイル名で保存する

         /* 画像ファイルがアップロード選択されていない場合、ダミーの画像のURLを入れる */

         $pass = "storage/img/ダミー.png";

        /* 必須項目以外のinputが空になっているか確認のため受け取った情報を取得 */
        $img_path = $request->file('img_path');
        $comment = $request->comment;


        /* ファイルがフォーム内で選択されていればファイルのパスを取得し$passへ代入する */
         if(!empty($img_path)) {
         $file_name = $request->file('img_path')->getClientOriginalName();

         // 取得したファイル名で保存
         // storage/app/public/任意のディレクトリ名/
         $request->file('img_path')->storeAs('public/' . $dir, $file_name);

         $pass = "storage/img/".$file_name;


        }


        /* ファイルがフォーム内でコメントが存在すれば取得し$commentへ代入する */
        if(isset($request->comment)) { } else {$comment = '登録されたコメントはありません'; }


        // ファイル情報をDBに保存
        /* データを挿入する方法 $image->name = $request->price; */
        $products = new Products();

        $products->companies_id = $maxUserId;
        $products->product_name = $request->product_name;
        $products->price = $request->price;
        $products->stock = $request->stock;
        $products->comment = $comment;
        $products->img_path = $pass;

        $products->save();

        $companies = new Companies();
        $companies->company_name = $request->company_name;
        $companies->street_address = '住所';
        $companies->representative_name = '代表者名';
        $companies->save();

    }

    public function products_save($request,$id){

            // ディレクトリ名
            $dir = 'img';

            // （備忘録）ランダムな名前でsampleディレクトリに画像を保存する場合は以下になる
            // $request->file('image')->store('public/' . $dir);


            /* 初めに画像ファイルがアップロード選択されていない用にダミーの画像のURLを入れる */
            $pass = "storage/img/ダミー.png";



            /* 必須項目以外のinputがNULLか確認のためフォームの情報を取得 */
            $img_path = $request->file('img_path');


        if(!empty($img_path)) {
            /* フォームでファイルが参照されていればそのファイル名を登録する */
            $file_name = $request->file('img_path')->getClientOriginalName();

            // 取得したファイル名で保存
            // storage/app/public/任意のディレクトリ名/
            $request->file('img_path')->storeAs('public/' . $dir, $file_name);

            $pass = "storage/img/".$file_name;


           }

           /* フォームに入力されたコメントがnullか確認する */
           $comment = $request->comment;
           if(isset($request->comment)) { } else {$comment = '登録されたコメントはありません';}

           // ファイル情報をDBに保存
           /* データを挿入する方法 $image->name = $request->price; */
           $products = Products::findOrFail($id);

           $products->product_name = $request->product_name;
           $products->price = $request->price;
           $products->stock = $request->stock;
           $products->comment = $comment;
           $products->img_path = $pass;

           $products->save();


  }



  public function products_destroy($id){

          // 削除対象レコードを検索
          $products = Products::findOrFail($id);

          // 削除
          $products->delete();
  }



}
