<?php

namespace App\Http\Controllers;

use App\Filters\PostFilter;
use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index(PostFilter $filter): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $categories = Category::all();
        $posts = Post::filter($filter)->latest()->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $categories = Category::all();

        return view('blog.show', compact('post', 'categories'));
    }
}
