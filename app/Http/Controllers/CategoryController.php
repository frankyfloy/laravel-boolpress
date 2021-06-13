<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('guests.categories.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $idCategory = Category::with('posts')->where('slug', '=' , $slug)->first();

        return view('guests.categories.show',[
            'posts' => $idCategory->posts,
            'name' => $idCategory->slug
        ]);
    }
}
