<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->get();
        
        $featuredProducts = Product::with('category')
            ->available()
            ->latest()
            ->take(8)
            ->get();

        $recentSold = Product::with('category')
            ->sold()
            ->latest()
            ->take(4)
            ->get();

        $latestBlogs = Blog::latest()
            ->take(3)
            ->get();

        $stats = [
            'total_curated' => Product::count(),
            'total_sold' => Product::where('status', 'sold')->count(),
            'savings_avg' => '45%',
            'eco_friendly' => '100%'
        ];

        return view('home', compact('categories', 'featuredProducts', 'recentSold', 'latestBlogs', 'stats'));
    }

    public function about(): View
    {
        return view('about');
    }

    public function contact(): View
    {
        return view('contact');
    }
}
