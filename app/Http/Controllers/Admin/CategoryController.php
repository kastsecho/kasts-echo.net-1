<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $categories = Category::withTrashed()->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        Category::create($request->validated());

        return to_route('admin.categories.index');
    }

    public function show(Category $category): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $category->update($request->validated());

        return to_route('admin.categories.show', $category);
    }

    public function destroy(Category $category): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $category->delete();

        return to_route('admin.categories.index');
    }

    public function restore($category): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        Category::onlyTrashed()->findOrFail($category)->restore();

        return to_route('admin.categories.index');
    }
}
