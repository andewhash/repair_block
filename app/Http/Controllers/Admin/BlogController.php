<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'author'])
                   ->latest()
                   ->paginate(10);
        
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $authors = User::where('role', 'admin')->orWhere('role', 'editor')->get();
        
        return view('admin.blogs.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'author_id' => 'required|exists:users,id',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_category' => 'nullable|string|max:255' // Для создания новой категории
        ]);

        // Создаем новую категорию, если указана
        if ($request->new_category) {
            $category = BlogCategory::create([
                'name' => $request->new_category,
                'slug' => Str::slug($request->new_category)
            ]);
            $categoryId = $category->id;
        } else {
            $categoryId = $request->category_id;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        Blog::create([
            'category_id' => $categoryId,
            'author_id' => $request->author_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Пост успешно создан');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        $authors = User::where('role', 'admin')->orWhere('role', 'editor')->get();
        
        return view('admin.blogs.edit', compact('blog', 'categories', 'authors'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'author_id' => 'required|exists:users,id',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_category' => 'nullable|string|max:255'
        ]);

        // Создаем новую категорию, если указана
        if ($request->new_category) {
            $category = BlogCategory::create([
                'name' => $request->new_category,
                'slug' => Str::slug($request->new_category)
            ]);
            $categoryId = $category->id;
        } else {
            $categoryId = $request->category_id;
        }

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        $blog->update([
            'category_id' => $categoryId,
            'author_id' => $request->author_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Пост успешно обновлен');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        
        $blog->delete();
        
        return back()->with('success', 'Пост успешно удален');
    }
}