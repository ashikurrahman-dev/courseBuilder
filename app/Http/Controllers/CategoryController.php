<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;  

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $request->validated();
        $category['slug'] = str::slug($request->validated('name'), '-');

        $data = Category::create($category);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $attributes = $request->validated();
        $attributes['slug'] = str::slug($request->validated('name'), '-');
        $category->update($attributes);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
