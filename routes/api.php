<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SalesController;

Route::middleware(['middleware' => 'api'])->group(function () {
    # 投稿作成
    Route::post('/posts/create', 'SalesController@create');
    # 投稿一覧表示
    Route::get('/posts', 'PostController@index');
    # 投稿表示
    Route::get('/posts/{id}', 'PostController@show');
    # 投稿編集
    Route::patch('/posts/update/{id}' , 'PostController@update');
    # 投稿削除
    Route::delete('/posts/{id}', 'PostController@delete');
});
