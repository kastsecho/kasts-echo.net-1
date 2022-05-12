<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $posts = Post::withTrashed()->latest()->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        Post::create($request->validated());

        return to_route('admin.posts.index');
    }

    public function show(Post $post): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $post->update($request->validated());

        return to_route('admin.posts.show', $post);
    }

    public function destroy(Post $post): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $post->delete();

        return to_route('admin.posts.index');
    }

    public function restore($post): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        Post::onlyTrashed()->findOrFail($post)->restore();

        return to_route('admin.posts.index');
    }
}
