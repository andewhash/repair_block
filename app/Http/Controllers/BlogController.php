<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'author'])
                ->latest();

        // Поиск по заголовку или содержимому
        if ($request->get('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Фильтр по категории
        if ($request->get('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        $blogs = $query->paginate(5);
        $popularPosts = Blog::orderBy('views', 'desc')->limit(3)->get();
        $categories = BlogCategory::withCount('blogs')->get();

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
