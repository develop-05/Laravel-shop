<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->get();
        $basket_cnt = Product::onlyTrashed()->count();
        return view('admin.product.index', compact('products', 'basket_cnt'));
    }

    public function create()  // форма створення
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request) // збереження
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);
        return redirect()->route('admin.products.index');
    }

    public function show($id) // перегляд одного
    {}

    public function edit($id) // форма редагування
    {

        $product = Product::query()->findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(UpdateProductRequest $request, string $id) // оновлення
    {
        $product = Product::query()->findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); // зберігаємо у storage/app/public/products
            $validated['image'] = $path;
        }

        $product->update($validated);
        return redirect()->route('admin.products.index');
    }

    public function destroy($id) // видалення
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function basket()
    {
        $products = Product::onlyTrashed()->get();
        $basket_cnt = $products->count();

        return view('admin.product.basket', compact('products', 'basket_cnt'));
    }

    public function basketRestore(string $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('admin.admin.products.basket');
    }

    public function basketRemove(string $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('admin.admin.products.basket');
    }
}
