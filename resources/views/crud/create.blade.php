@extends('layouts.app')

@section('content')

<div class="w-75 mx-auto" style="margin-top:50px;">

  <form method="POST" action="/store" enctype="multipart/form-data">
  {{ csrf_field() }}

              <!--商品名-->
            <div class="form-group row">
                <label for="product_name" class="col-sm-2 col-form-label">商品名</label>
                <div class="col-sm-10">
                    <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control @if($errors->has('product_name')) is-invalid @endif" id="product_name" placeholder="商品名" required>
                    @if($errors->has('product_name'))
                        <div class="invalid-feedback">{{ $errors->first('product_name') }}</div>
                    @else
                        <div class="invalid-feedback">必須項目です</div><!--HTMLバリデーション-->
                    @endif
                </div>
            </div>


            <!--メーカー名-->
          <div class="form-group row">
              <label for="company_name" class="col-sm-2 col-form-label">メーカー名</label>
              <div class="col-sm-10">
                  <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control @if($errors->has('company_name')) is-invalid @endif" id="company_name" placeholder="メーカー名" required>
                  @if($errors->has('company_name'))
                      <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                  @else
                      <div class="invalid-feedback">必須項目です</div><!--HTMLバリデーション-->
                  @endif
              </div>
          </div>
          <!--/価格-->

          <div class="form-group row">
              <label for="price" class="col-sm-2 col-form-label">商品価格</label>
              <div class="col-sm-10">
                  <input type="number" name="price" value="{{ old('price') }}" class="form-control @if($errors->has('price')) is-invalid @endif" id="inputEmail" placeholder="価格" required>
                  @if($errors->has('price'))
                      <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                  @else
                      <div class="invalid-feedback">必須項目です</div><!--HTMLバリデーション-->
                  @endif
              </div>
          </div>
          <!--/在庫数-->

          <div class="form-group row">
              <label for="stock" class="col-sm-2 col-form-label">在庫数</label>
              <div class="col-sm-10">
                  <input type="number" name="stock" value="{{ old('stock') }}" class="form-control @if($errors->has('stock')) is-invalid @endif" id="stock" placeholder="在庫" required>
                  @if($errors->has('stock'))
                      <div class="invalid-feedback">{{ $errors->first('stock') }}</div>
                  @else
                      <div class="invalid-feedback">必須項目です</div><!--HTMLバリデーション-->
                  @endif
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

    <button class="btn btn-success">アップロード</button>
  </form>

  <button style="margin-top:50px;" class="btn btn-primary" type=“button” onclick="location.href='/'">戻る</button>

</div>

@endsection
