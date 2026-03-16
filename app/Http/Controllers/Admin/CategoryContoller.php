<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryContoller extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create()  // форма створення
    {
        return view('admin.category.create');
    }

    public function store(Request $request) // збереження
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'meta_desc' => 'max:255',
            'slug' => 'max:255',
        ]);

        Category::create($validated);
        return redirect()->route('admin.categories.index');
    }

    public function show($id) // перегляд одного
    {}

    public function edit($id) // форма редагування
    {
        $category = Category::query()->findOrFail($id);
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, string $id) // оновлення
    {
        $category = Category::query()->findOrFail($id);

        $validated = $request->validate([
            'name' => 'max:255',
            'meta_desc' => 'max:255',
            'slug' => 'max:255',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id) // видалення
    {
        $category = Category::query()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('admin.categories.index');
    }

}
