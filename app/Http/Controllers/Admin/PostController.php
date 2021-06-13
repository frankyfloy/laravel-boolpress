<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request\
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'exists:categories,id|nullable',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->fill($request->all());

        $post->slug = $this->generateSlug($post->title);
        $post->save();
        $comic = Post::orderBy('id', 'desc')->first();
        return redirect()->route('admin.posts.show',$post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'exists:categories,id|nullable',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $editPost = $request->all();
        $editPost['slug'] = $this->generateSlug($editPost['title'], $post->title != $editPost['title'], $post->slug);
        $post->update($editPost);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        if (url()->previous() == 'http://localhost:8000/admin/posts') {
            return redirect()->route('admin.posts.index');
        }else {
            return redirect()->back();
        }

    }


    private function generateSlug(string $title, bool $change = true, string $old_slug = ''){

        $slug;

        if (!$change) {
            $slug = $old_slug;
        }else {
            $slug = Str::slug($title, '-');
            $slug_base = $slug;

            $contatore = 1;
            $post_with_slug = Post::where('slug', '=', $slug)->first();

            while ($post_with_slug) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;

                $post_with_slug = Post::where('slug', '=', $slug)->first();
            }
        }

        return $slug;
    }

}
