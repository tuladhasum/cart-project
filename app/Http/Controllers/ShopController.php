<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $pagination = 9;
        $categories = Category::all();

        if (request()->get('category')) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            $products = Product::where('featured', true)->take(3);
            $categoryName = "Featured";
        }

        if (request()->sort == 'low-high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high-low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop.index', compact('products', 'categories', 'categoryName'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        return view('shop.show', compact('product', 'mightAlsoLike'));
    }

}
