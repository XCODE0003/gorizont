<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function get(){
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ], [
            'name.required' => 'Поле название обязательно для заполнения',
            'name.string' => 'Поле название должно быть строкой',
            'name.max' => 'Поле название не должно превышать 255 символов',
            'name.unique' => 'Такое название категории уже существует'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['category' => $category]);
    }
}
