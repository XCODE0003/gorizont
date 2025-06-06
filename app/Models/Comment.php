<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'article_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Articles::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:i',
    ];
}
