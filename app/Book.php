<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'author',
    ];

    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];
}
