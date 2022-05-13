<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $categories = Category::all();
        $posts = Post::latest()->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $categories = Category::all();

        return view('blog.show', compact('post', 'categories'));
    }
}
