@extends('layouts.app')

@section('content')

@php
$sorts = ["desc"=>"降順","asc"=>"昇順"];
$columns = ["id"=>"id","img_path"=>"商品画像","product_name"=>"商品名","price"=>"価格","stock"=>"在庫数","company_name"=>"メーカー名","詳細表示","削除"]
@endphp



<table class="table table-striped" style="text-align:center;">
    <tr id="all_result">

        @foreach ($columns as $column => $value)
            <th scope="col">

                <p>{{$value}}</p>

                @if($value == "商品画像" || $value == "詳細表示" || $value == "削除")
                {{-- ループ　スキップ --}}
                @continue

                @endif

                    <select name={{$column}} id="sort" onchange="createList(this.name,this.value)">
                        @foreach ($sorts as $key => $value)


                                <option onchange="flight" value={{$key}} >{{$value}}</option>

                        @endforeach
                    </select>


            </th>
        @endforeach
        {{-- <th scope="col">id</th>
            <select onchange="flight()">
                <option value="">並び替え</option>
                <option value="">降順</option>
                <option value="">昇順</option>
            </select>
        </th>
        <th scope="col">商品画像</th>
        <th scope="col">商品名</th>
        <th scope="col">価格</th>
        <th scope="col">在庫数</th>
        <th scope="col">メーカー名</th>
        <th scope="col">詳細表示</th>
        <th scope="col">削除</th> --}}
    </tr>
</table>


<div class="col-md-4">


</div>

<!--CSRFトークン対策-->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div hidden class="col-md-12" id="conditions">
    <input id="condition">
    <input id="condition_high">
    <input id="condition_low">
</div>

<div class="card mb-5">



    <div class="card-header">条件検索(在庫数）</div>
    <div class="card-body">
        <p class="card-text">

        <div class="form-group row">
            <div class="col-md-4">在庫数の最大値を入力:</div>
            <div class="col-md-4">
                <input class="form-control" id="stock_high">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">在庫数の最小値を入力:</div>
            <div class="col-md-4">
                <input class="form-control" id="stock_low">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <button id="ajax_search" class="btn btn-info text-white">在庫検索ボタン</button>
            </div>
        </div>


    </div>
    <!-- 取得したレコードを表示 -->

    </p>
</div>

<div class="card mb-5">
    <div class="card-header">条件検索（価格）</div>
    <div class="card-body">
        <p class="card-text">

        <div class="form-group row">
            <div class="col-md-4">価格の最大値を入力:</div>
            <div class="col-md-4">
                <input class="form-control" id="price_high">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">価格の最小値を入力:</div>
            <div class="col-md-4">
                <input class="form-control" id="price_low">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <button id="ajax_search_price" class="btn btn-info text-white">価格検索ボタン</button>
            </div>
        </div>


    </div>
    <!-- 取得したレコードを表示 -->
    <div class="col-md-12" id="result"></div>
    </p>
</div>





<script src="js/indexAll.js"></script>
<script src="js/indexDel.js"></script>
<script src="js/indexSearch.js"></script>
<script src="js/indexSearch_price.js"></script>
<script src="js/dropdown.js"></script>
<script src="js/API_test.js"></script>


@endsection