<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $category = $request->query('category');
        $status = $request->query('status');

        $query = Product::with('category')->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        if ($category) {
            $query->where('category_id', $category);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories', 'search', 'category', 'status'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'product_condition' => 'required|in:Pecah/Minus,Layak Pakai,Sangat Baik,Seperti Baru',
            'status' => 'required|in:available,sold',
            'defect' => 'nullable|string',
            'completeness' => 'nullable|string|max:255',
            'usage_duration' => 'nullable|string|max:100',
            'seller_city' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product'), $filename);
            $validated['image'] = 'images/product/' . $filename;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk barang bekas berhasil ditambahkan!');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'product_condition' => 'required|in:Pecah/Minus,Layak Pakai,Sangat Baik,Seperti Baru',
            'status' => 'required|in:available,sold',
            'defect' => 'nullable|string',
            'completeness' => 'nullable|string|max:255',
            'usage_duration' => 'nullable|string|max:100',
            'seller_city' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan bukan gambar bawaan seeder
            if ($product->image && File::exists(public_path($product->image)) && !str_contains($product->image, 'sample')) {
                File::delete(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = 'product_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product'), $filename);
            $validated['image'] = 'images/product/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Informasi produk berhasil diperbarui!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image && File::exists(public_path($product->image)) && !str_starts_with($product->image, 'images/product/product_')) {
            File::delete(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus dari sistem.');
    }
}
