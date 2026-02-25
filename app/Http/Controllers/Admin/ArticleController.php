<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])->latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $type = $file->getClientOriginalExtension();
            $data = file_get_contents($file->getRealPath());
            $imagePath = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'content' => $validated['content'],
            'image' => $imagePath,
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $type = $file->getClientOriginalExtension();
            $data = file_get_contents($file->getRealPath());
            $article->image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}
