<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        // kategori
        if ($request->filled('category')) {
            $products->whereIn('category', $request->category);
        }

        // harga
        if ($request->filled('min_price')) {
            $products->where('price_per_day', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $products->where('price_per_day', '<=', $request->max_price);
        }

        // stok
        if ($request->filled('available')) {
            $products->where('stock', '>', 0);
        }

        $products = $products->paginate(9)->withQueryString();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
