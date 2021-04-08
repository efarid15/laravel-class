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

    public function scopeAuthorId($query, $author_id)
    {
        return $query->where('author_id', $author_id);
    }

    public function scopeArchived($query, $book_ids)
    {
        return $query->onlyTrashed()->whereIn('id', $book_ids);
    }
}
