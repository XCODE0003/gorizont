<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Subscribe;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request) {
        $query = Articles::with(['author', 'category']);

        $filter = $request->get('filter');
        $categoryId = $request->get('category');

        if ($filter === 'subscriptions' && Auth::check()) {
            $subscriptions = Subscribe::where('user_id', Auth::id())->pluck('subscribe_id');
            $query->whereIn('user_id', $subscriptions);
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $articles = $query->latest()->get()->toArray();
        $articles = array_map(function($article) {
            $article['description'] = $this->truncateText($article['content']);
            return $article;
        }, $articles);

        $categories = Category::take(10)->get()->toArray();
        return Inertia::render('Index', [
            'articles' => $articles,
            'categories' => $categories,
            'currentFilter' => $filter,
            'currentCategory' => $categoryId
        ]);
    }


    private function truncateText($text, $lines = 2, $charsPerLine = 80) {
        if (!is_string($text)) {
            $text = (string)$text;
        }

        $plainText = preg_replace('/<[^>]*>/', '', $text);

        $plainText = html_entity_decode($plainText);
        $plainText = preg_replace('/&[a-zA-Z0-9#]+;/', '', $plainText);

        $plainText = preg_replace('/\s+/', ' ', trim($plainText));

        $maxLength = $lines * $charsPerLine;

        if (mb_strlen($plainText) > $maxLength) {
            $truncated = mb_substr($plainText, 0, $maxLength);
            $lastSpace = mb_strrpos($truncated, ' ');
            if ($lastSpace !== false) {
                $truncated = mb_substr($truncated, 0, $lastSpace);
            }
            return $truncated . '...';
        }

        return $plainText;
    }
}
