<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'author'])
                   ->latest()
                   ->paginate(5);
        
        $popularPosts = Blog::orderBy('views', 'desc')
                          ->limit(3)
                          ->get();
        
        $categories = BlogCategory::withCount('blogs')
                            ->orderBy('blogs_count', 'desc')
                            ->get();

        return view('blog.index', compact('blogs', 'popularPosts', 'categories'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'author', 'comments'])
                  ->where('slug', $slug)
                  ->firstOrFail();
        
        // Увеличиваем счетчик просмотров
        $blog->increment('views');
        
        $previous = Blog::where('id', '<', $blog->id)->latest('id')->first();
        $next = Blog::where('id', '>', $blog->id)->oldest('id')->first();
        
        $popularPosts = Blog::orderBy('views', 'desc')
                          ->limit(3)
                          ->get();
        
        $categories = BlogCategory::withCount('blogs')
                            ->orderBy('blogs_count', 'desc')
                            ->get();

        return view('blog.show', compact('blog', 'previous', 'next', 'popularPosts', 'categories'));
    }
}
