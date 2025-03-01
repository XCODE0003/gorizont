<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Articles;
class PostController extends Controller
{
    public function new()
    {
        return Inertia::render('Post/newPost');
    }

    public function index($id)
    {
        $article = Articles::find($id);
        return Inertia::render('Post/Post', ['article' => $article]);
    }

    public function edit($id)
    {
        
        $article = Articles::find($id);
        if(!$article || $article->user_id !== auth()->user()->id) {
            return redirect('/');
        }
        return Inertia::render('Post/editPost', ['article' => $article]);
    }

    public function destroy($id)
    {
        $article = Articles::find($id);
        $user = auth()->user();
        if(!$article || $article->user_id !== $user->id) {
            return redirect('/');
        }
        $article->delete();
        return response()->json(['success' => true, 'message' => 'Статья успешно удалена']);
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'comment' => 'required|boolean',
            ],
            [
                'title.required' => 'Поле название обязательно для заполнения',
                'title.string' => 'Поле название должно быть строкой',
                'title.max' => 'Поле название не должно превышать 255 символов',
                'content.required' => 'Поле содержание обязательно для заполнения',
                'content.string' => 'Поле содержание должно быть строкой',
                'category_id.required' => 'Поле категория обязательно для заполнения',
                'category_id.exists' => 'Категория не найдена',
                'image.required' => 'Поле изображение обязательно для заполнения',
                'image.image' => 'Поле изображение должно быть изображением',
                'image.mimes' => 'Поле изображение должно быть изображением',
                'comment.required' => 'Поле комментарии обязательно для заполнения',
                'comment.boolean' => 'Поле комментарии должно быть булевым',
            ]
        );
        
        $article = Articles::find($id);
        if(!$article || $article->user_id !== auth()->user()->id) {
            return redirect('/');
        }
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : $article->image,
            'comment' => $request->comment,
        ]);
        return response()->json(['message' => 'Статья успешно обновлена']);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'comment' => 'required|boolean',
            ],
            [
                'title.required' => 'Поле название обязательно для заполнения',
                'title.string' => 'Поле название должно быть строкой',
                'title.max' => 'Поле название не должно превышать 255 символов',
                'content.required' => 'Поле содержание обязательно для заполнения',
                'content.string' => 'Поле содержание должно быть строкой',
                'category_id.required' => 'Поле категория обязательно для заполнения',
                'category_id.exists' => 'Категория не найдена',
                'image.required' => 'Поле изображение обязательно для заполнения',
                'image.image' => 'Поле изображение должно быть изображением',
                'image.mimes' => 'Поле изображение должно быть изображением',
                
            ]
        );
        $article = Articles::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null,
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
        ]);
        
        return response()->json(['message' => 'Статья успешно создана', 'article' => $article]);
    }
}
