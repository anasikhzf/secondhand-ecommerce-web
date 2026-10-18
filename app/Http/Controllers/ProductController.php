<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $categorySlug = $request->query('category');
        $condition = $request->query('condition');
        $status = $request->query('status', 'all');
        $sort = $request->query('sort', 'latest');

        $query = Product::with('category');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('defect', 'like', "%{$search}%");
            });
        }

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($condition && in_array($condition, ['Pecah/Minus', 'Layak Pakai', 'Sangat Baik', 'Seperti Baru'])) {
            $query->where('product_condition', $condition);
        }

        if ($status === 'available') {
            $query->where('status', 'available');
        } elseif ($status === 'sold') {
            $query->where('status', 'sold');
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'condition':
                $query->orderByRaw("FIELD(product_condition, 'Seperti Baru', 'Sangat Baik', 'Layak Pakai', 'Pecah/Minus')");
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories', 'search', 'categorySlug', 'condition', 'status', 'sort'));
    }

    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
