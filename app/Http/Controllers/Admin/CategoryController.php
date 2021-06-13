<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new  Category();
        $category->fill($request->all());

        $category->slug = $this->generateSlug($category->name);
        $category->save();
        $category = Category::orderBy('id', 'desc')->first();

        return redirect()->route('admin.category.show',$category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = Post::where('category_id', '=', $category->id)->get();
        return view('admin.categories.show', compact('category','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $editCategory = $request->all();
        $editCategory['slug'] = $this->generateSlug($editCategory['name'], $category->name != $editCategory['name'], $category->slug);
        $category->update($editCategory);

        return redirect()->route('admin.category.show',$category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Post::where('category_id', '=', $category->id)->delete();
        $category->delete();
        return redirect()->back();
    }

    private function generateSlug(string $name, bool $change = true, string $old_slug = ''){

        $slug;

        if (!$change) {
            $slug = $old_slug;
        }else {
            $slug = Str::slug($name, '-');
            $slug_base = $slug;

            $contatore = 1;
            $category_with_slug = Category::where('slug', '=', $slug)->first();

            while ($category_with_slug) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;

                $category_with_slug = Category::where('slug', '=', $slug)->first();
            }
        }

        return $slug;
    }
}
