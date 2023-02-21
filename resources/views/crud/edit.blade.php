@extends('layouts.app')

@section('content')

<div class="w-75 mx-auto" style="margin-top:50px;">

  <form method="POST" action="/update/{{$companies->id}}" enctype="multipart/form-data">
  {{ csrf_field() }}

            <div style="display:flex  ">
                <label for="product_name" class="">商品情報ID</label>
                <div class="" style="margin-left:100px;">
                <p class="right">{{ $companies->id }}</p>
                </div>
            </div>

              <!--商品名-->
            <div class="form-group row">
                <label for="product_name" class="col-sm-2 col-form-label">商品名</label>
                <div class="col-sm-10">
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="商品名" required>

                </div>
            </div>


            <!--メーカー名-->
          <div class="form-group row">
              <label for="company_name" class="col-sm-2 col-form-label">メーカー名</label>
              <div class="col-sm-10">
                  <input type="text" name="company_name" class="form-control" id="company_name" placeholder="メーカー名" required>

              </div>
          </div>
          <!--/価格-->

          <div class="form-group row">
              <label for="price" class="col-sm-2 col-form-label">商品価格</label>
              <div class="col-sm-10">
                  <input type="number" name="price" value="{{ old('price') }}" class="form-control" id="inputEmail" placeholder="価格" required>

              </div>
          </div>
          <!--/在庫数-->

          <div class="form-group row">
              <label for="stock" class="col-sm-2 col-form-label">在庫数</label>
              <div class="col-sm-10">
                  <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" id="stock" placeholder="在庫" required>

              </div>
          </div>


          <!--コメント-->
          <div class="form-group pb-3">
              <label for="Textarea">コメント</label>
              <textarea name="comment" class="form-control" id="comment" rows="3" placeholder="コメント" ></textarea>

          </div>

          <!--商品画像-->
          <div class="form-group pb-3">
              <label for="img_path">商品画像</label>
              <input type="file" name="img_path"  class="form-control" id="img_path" placeholder="ファイルを選択" >

          </div>

    <button class="btn btn-warning">編集した内容に更新する</button>
  </form>

  <button style="margin-top:50px;" class="btn btn-primary" type=“button” onclick="location.href='/show/{{$companies->id}}'">戻る</button>

</div>

@endsection
