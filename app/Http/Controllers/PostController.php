<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->get('search');

        $posts = Post::query();

        if ($search_query) {
            $posts->search($search_query);
        }

        $posts = $posts->where('is_published',true)->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $post->update($request->validated());
        return redirect()->route('post.index');
    }

    public function destory(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

}
