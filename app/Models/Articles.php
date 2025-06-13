<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id',
        'comment',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'article_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }
    public function likesCount()
    {
        return $this->likes()->count();
    }

}
