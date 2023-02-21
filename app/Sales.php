<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
     // fillableに指定したプロパティは入力可能になる
     protected  $fillable = [
        'title',
        'content',
      ];
}
