<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');

        $query = Blog::latest();

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        $blogs = $query->paginate(6)->withQueryString();

        return view('blogs.index', compact('blogs', 'search'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
