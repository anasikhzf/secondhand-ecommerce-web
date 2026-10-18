<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $availableProducts = Product::where('status', 'available')->count();
        $soldProducts = Product::where('status', 'sold')->count();
        $totalCategories = Category::count();
        $totalBlogs = Blog::count();
        $totalOrders = Order::count();

        // Data sebaran kategori untuk Chart.js
        $categoryDistribution = Category::withCount('products')->get();
        $catLabels = $categoryDistribution->pluck('name')->toArray();
        $catCounts = $categoryDistribution->pluck('products_count')->toArray();

        // Data kondisi barang bekas untuk Chart.js
        $conditionStats = Product::selectRaw('product_condition, count(*) as total')
            ->groupBy('product_condition')
            ->pluck('total', 'product_condition')
            ->toArray();

        $recentProducts = Product::with('category')->latest()->take(5)->get();
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'availableProducts',
            'soldProducts',
            'totalCategories',
            'totalBlogs',
            'totalOrders',
            'catLabels',
            'catCounts',
            'conditionStats',
            'recentProducts',
            'recentOrders'
        ));
    }
}
