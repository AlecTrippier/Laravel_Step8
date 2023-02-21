<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'gender',
        'age',
        'address',
        'tel'
    ];
}
