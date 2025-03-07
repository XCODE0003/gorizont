<?php

namespace App\Services\Article;

use App\Models\Articles;

class Get
{
    public function execute($id)
    {
        $article = Articles::find($id);
        
        if (!$article) {
            return null;
        }
        $author = $article->user;

        $isLiked = auth()->check() ? 
            $article->likes()->where('user_id', auth()->user()->id)->exists() : 
            false;

        $comments = $article->comments()->get();
        $likesCount = $article->likesCount();
        $article->likesCount = $likesCount;

        return [
            'article' => $article,
            'isLiked' => $isLiked, 
            'comments' => $comments,
            'author' => $author
        ];
    }
}
