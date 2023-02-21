<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Products;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */





public function showAll()
{
    /* $companies = \DB::table('companies')->get(); */
    $companies = Companies::orderBy("ID","desc")
    ->get();

    foreach($companies as $companie){
        $companieList[] = array(
          'id'    => $companie->id,
          'img'   => $companie->products->img_path,
          'name'  => $companie->products->product_name,
          'price' => $companie->products->price,
          'stock' => $companie->products->stock,
          'companyName' => $companie->company_name,

        );
    }



    // htmlへ渡す配列$productListをjsonに変換する
        echo json_encode($companieList);




}

    /* ---追加部分ここまで--- */

    public function index(Request $request)
    {

        DB::beginTransaction();

    try {
        /* インスタンス呼び出し */
        $companies = new Companies();
        $posts = $companies->index_table($request);
        // データ操作を確定させる
        DB::commit();
    } catch(Exception $exception) {
        // データ操作を巻き戻す
        DB::rollBack();
        throw $exception;
    }
        return view('crud.index', ['posts' => $posts]);

    }


    public function show($id)
    {

        $companies = Companies::findOrFail($id);
        return view('crud.show')->with('companies',$companies);
    }

    public function edit($id)
    {
        $companies = Companies::findOrFail($id);
        return view('crud.edit')->with('companies',$companies);
    }



    public function create()
    {
        return view('crud.create');
    }



    public function store(Request $request)
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            /* インスタンス呼び出し */
            $products = new Products();
            $posts = $products->store_process($request);
            // データ操作を確定させる
            DB::commit();
        } catch(Exception $exception) {
            // データ操作を巻き戻す
            DB::rollBack();
            throw $exception;
        }

            return redirect('/');

    }

    public function update(Request $request, $id)
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            /* インスタンス呼び出し */
        $products = new Products();
        $save = $products->products_save($request,$id);


        /* インスタンス呼び出し */
        $companies = new Companies();
        $save = $companies->companies_save($request,$id);
            // データ操作を確定させる
            DB::commit();
        } catch(Exception $exception) {
            // データ操作を巻き戻す
            DB::rollBack();
            throw $exception;
        }

        return redirect('/');

    }

    public function destroy(Request $request, Companies $companies) {


         // トランザクション開始
         DB::beginTransaction();

         try {
            $companies = Companies::findOrFail($request->id);
            $companies->delete();


            $Products = Products::findOrFail($request->id);
            $Products->delete();
             // データ操作を確定させる
             DB::commit();
         } catch(Exception $exception) {
             // データ操作を巻き戻す
             DB::rollBack();
             throw $exception;
         }

    }


    /**
 * products 1件削除
 */
    public function del(Request $request)
    {
        $id = $request->input('id');

        // 削除レコード取得
        $products = \DB::table('Companies')->where('id',$id)->get();

        // 削除処理
        $count = \DB::table('Companies')->where('id',$id)->delete();



        /* $companies = \DB::table('companies')->get(); */
    $companies = Companies::get();

    foreach($companies as $companie){
        $companieList[] = array(
          'id'    => $companie->id,
          'img'   => $companie->products->img_path,
          'name'  => $companie->products->product_name,
          'price' => $companie->products->price,
          'stock' => $companie->products->stock,
          'companyName' => $companie->company_name,

        );
    }

    header('Content-type: application/json');

    // htmlへ渡す配列$productListをjsonに変換する
        echo json_encode($companieList);
    }


    public function search(Request $request){

        $high = $request->input('high');
        $low = $request->input('low');
        $sort = "desc";
        if(is_null($low)){$low = 0;} /* 入力が空の場合は0を最下値に0を代入する */


        $companies = Companies::whereHas('products', function($query) use($low) {
            // stockカラムから検索（上限下限）
            $query->where('stock', '>=',$low); }) ////下限を検索
            ->whereHas('products', function($query) use($high) {

                if($high){ //上限を検索
                $query->where('stock', '<=',$high);
                }
            })
            ->orderBy('id', $sort)->get(); /* descは IDの降順で取得する ascは昇順で取得する*/



    /* 文字列を挿入する場合は"%{$keyword}%" */
    /* 値を挿入する場合は変数をそのまま入力する */

    $companieList = array();
    foreach($companies as $companie){
        $companieList[] = array(
          'id'    => $companie->id,
          'img'   => $companie->products->img_path,
          'name'  => $companie->products->product_name,
          'price' => $companie->products->price,
          'stock' => $companie->products->stock,
          'companyName' => $companie->company_name,
        );
    }

    $test = $low;

    header('Content-type: application/json');
    echo json_encode($companieList,$test);


    }

    public function search_price(Request $request){

        $high = $request->input('high');
        $low = $request->input('low');
        if(is_null($low)){$low = 0;} /* 入力が空の場合は0を最下値に0を代入する */


        $companies = Companies::whereHas('products', function($query) use($low) {
            // stockカラムから検索（上限下限）
            $query->where('price', '>=',$low); }) ////下限を検索
            ->whereHas('products', function($query) use($high) {

                if($high){ //上限を検索
                $query->where('price', '<=',$high);
                }
            })->get();



    /* 文字列を挿入する場合は"%{$keyword}%" */
    /* 値を挿入する場合は変数をそのまま入力する */

    $companieList = array();
    foreach($companies as $companie){
        $companieList[] = array(
          'id'    => $companie->id,
          'img'   => $companie->products->img_path,
          'name'  => $companie->products->product_name,
          'price' => $companie->products->price,
          'stock' => $companie->products->stock,
          'companyName' => $companie->company_name,
        );
    }

    header('Content-type: application/json');
    echo json_encode($companieList);

    }

    public function sort(Request $request){

        $condition = $request->input('condition');
        $column = $request->input('column');

        $order = $request->input('order');


        switch($condition){

            case "all":
                $companies = Companies::select("companies.*")
                    ->join('products','companies.id','=','products.companies_id')

                    ->orderBy($column, $order)
                    ->get();
                break;

            case "stock":
                    $high = $request->input('high');
                    $low = $request->input('low');
                    if(is_null($low)){$low = 0;} /* 入力が空の場合は0を最下値に0を代入する */

                    $companies = Companies::select("companies.*")
                    ->join('products','companies.id','=','products.companies_id')
                    ->where('stock', '>=',$low) ////下限を検索
                    ->whereHas('products', function($query) use($high) {

                        if($high){ //上限を検索
                        $query->where('stock', '<=',$high);
                        }
                    })
                    ->orderBy($column, $order)
                    ->get();

                break;

            case "price":
                    $high = $request->input('high');
                    $low = $request->input('low');
                    if(is_null($low)){$low = 0;} /* 入力が空の場合は0を最下値に0を代入する */

                    $companies = Companies::whereHas('products', function($query) use($low) {
                        // stockカラムから検索（上限下限）
                        $query->where('price', '>=',$low); }) ////下限を検索
                        ->whereHas('products', function($query) use($high) {

                            if($high){ //上限を検索
                            $query->where('price', '<=',$high);
                            }
                             })->get();

                break;
        }



    /* 文字列を挿入する場合は"%{$keyword}%" */
    /* 値を挿入する場合は変数をそのまま入力する */

    $companieList = array();
    foreach($companies as $companie){
        $companieList[] = array(
          'id'    => $companie->id,
          'img'   => $companie->products->img_path,
          'name'  => $companie->products->product_name,
          'price' => $companie->products->price,
          'stock' => $companie->products->stock,
          'companyName' => $companie->company_name,
        );
    }

    header('Content-type: application/json');
    echo json_encode($companieList);

    }


}
