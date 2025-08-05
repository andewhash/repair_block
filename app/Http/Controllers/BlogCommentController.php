<?php
namespace App\Http\Controllers;

use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|min:1|max:2000',
        ]);

        BlogComment::create($validated + [
            'approved' => true
        ]);

        return back()->with('success', 'Комментарий отправлен на модерацию!');
    }
}