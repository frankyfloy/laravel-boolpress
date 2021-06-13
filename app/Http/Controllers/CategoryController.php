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
        // dd($slug);
        $idCategory = Category::where('slug', '=' , $slug)->first();
        // dd($idCategory->id);
        $posts = Post::where('category_id', '=' , $idCategory->id)->get();
        return view('guests.categories.show', compact('posts','slug'));
    }

    // $posts = Post::where('category_id', '=', $category->id)->get();
    // return view('admin.categories.show', compact('category','posts'));

}
