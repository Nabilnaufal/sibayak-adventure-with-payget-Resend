<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('sku', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->kategori) {
            $query->where('category', $request->kategori);
        }

        if ($request->status) {
            if ($request->status == 'available') {
                $query->where('stock', '>', 5);
            } elseif ($request->status == 'low') {
                $query->whereBetween('stock', [1, 5]);
            } elseif ($request->status == 'out') {
                $query->where('stock', 0);
            }
        }

        $products = $query->latest()->paginate(8)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price_per_day' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ UPLOAD MANUAL (INFINITYFREE SAFE)
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('storage/products'), $fileName);

            $validated['image'] = 'storage/products/'.$fileName;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambah!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'Products' => Product::all(),
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,'.$product->id,
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price_per_day' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // hapus file lama
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $fileName = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('storage/products'), $fileName);

            $validated['image'] = 'storage/products/'.$fileName;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
