<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Articles;
use App\Models\Comment;
class CommentController extends Controller
{
    public function new(Request $request)
    {
        $user = $request->user();
        $post = Articles::find($request->post_id);
        if(!$post) {
            return response()->json(['error' => 'Пост не найден'], 404);
        }
        if(!$post->comment) {
            return response()->json(['error' => 'Комментарии отключены'], 404);
        }
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);
        return response()->json(['success' => 'Комментарий добавлен', 'comment' => $comment], 200);
    }

    public function get(Request $request)
    {
        $comments = Comment::where('post_id', $request->post_id)->get();
        return response()->json(['comments' => $comments], 200);
    }

    public function delete(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        if(!$comment) {
            return response()->json(['error' => 'Комментарий не найден'], 404);
        }
        if($comment->user_id != $request->user()->id) {
            return response()->json(['error' => 'Вы не можете удалить этот комментарий'], 403);
        }
        $comment->delete();
        return response()->json(['success' => 'Комментарий удален'], 200);
    }
    
}
