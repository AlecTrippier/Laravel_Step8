@extends('layouts.app')



@section('content')

<style>

.show_wrapper{
  margin-top:30px;
  margin-left:100px;
  display:flex;

}

.show_wrapper .left{
  width:80px;
}

.show_wrapper .right{
  margin-left:100px;

}

.show_btn{
  width:80px;
  margin-top: 20px;
  margin-left:100px;
}

</style>



<div class="wrapper">
  <!--id-->
  <div class="show_wrapper">
        <p  class="left">商品情報ID</p>
        <p class="right">{{ $companies->id }}</p>
  </div>
  <!-- img_path -->
  <div class="show_wrapper">
  <img style="width:300px;" src="{{asset($companies->products->img_path)}}" >
      <!--   <p class="right"><img src="storage/img/ファンタオレンジ.jpeg"></p> -->
  </div>
  <!--product_name-->
  <div class="show_wrapper">
        <p  class="left">商品名</p>
        <p class="right">{{ $companies->products->product_name }}</p>
  </div>
  <!--company_name-->
  <div class="show_wrapper">
        <p  class="left">メーカー</p>
        <p class="right">{{ $companies->company_name }}</p>
  </div>
  <!--price-->
  <div class="show_wrapper">
        <p  class="left">価格</p>
        <p class="right">{{ $companies->products->price }}</p>
  </div>
  <!--stock-->
  <div class="show_wrapper">
        <p  class="left">在庫数</p>
        <p class="right">{{ $companies->products->stock }}</p>
  </div>
  <!--comment-->
  <div class="show_wrapper">
        <p  class="left">コメント</p>
        <p class="right">{{ $companies->products->comment }}</p>
  </div>
</div>

<button style="width:100px;" class="show_btn btn-warning" type=“button” onclick="location.href='/edit/{{$companies->id}}'">編集</button>

<button class="show_btn btn btn-primary" type=“button” onclick="location.href='/'">戻る</button>






@endsection
