<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
   public function index()
{
    $products = Product::with('category')->orderBy('id', 'desc')->paginate(5);
    $categories = Category::all();

    return view('welcome', compact('products', 'categories'));
}

    public function add($id)
    {
        $product = Product::query()->findOrFail($id);
        $categories = Category::all();
    }

    public function filter(Request $request)
    {
        //  dd($request->all());
        $categories = Category::all();
        $products = Product::query()

            // Пошук по name
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })

            // Мінімальна ціна
            ->when($request->filled('max_price'), function ($query) use ($request) {
                return $query->where('price', '<=', $request->max_price);
            })

            // Максимальна ціна
            ->when($request->filled('min_price'), function ($query) use ($request) {
                return $query->where('price', '>=', $request->min_price);
            })

            ->when($request->filled('category_id'), function ($query) use ($request) {
            // Фільтруємо по category_id
            return $query->where('category_id', $request->category_id);
        })

            ->paginate(5)
            ->withQueryString();

        return view('welcome', compact('products', 'categories'));
    }
}
