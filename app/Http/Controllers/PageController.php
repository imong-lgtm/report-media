<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredArticles = Article::with('category')->where('status', 'published')->latest()->take(5)->get();
        $latestArticles = Article::with('category')->where('status', 'published')->latest()->skip(5)->take(20)->get();

        // Fetch categories with at least 3 articles for section display
        $categoriesWithArticles = Category::with([
            'articles' => function ($query) {
                $query->where('status', 'published')->latest()->take(4);
            }
        ])->get()->filter(function ($category) {
            return $category->articles->count() > 0;
        });

        return view('home', compact('featuredArticles', 'latestArticles', 'categoriesWithArticles'));
    }

    public function showArticle($slug)
    {
        $article = Article::with(['category', 'user'])->where('slug', $slug)->firstOrFail();
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function about()
    {
        $teams = \App\Models\Team::all();
        return view('about', compact('teams'));
    }

    public function services()
    {
        $services = Service::all();
        return view('services', compact('services'));
    }

    public function projects()
    {
        $projects = Project::latest()->get();
        return view('projects', compact('projects'));
    }

    public function contact()
    {
        return view('contact');
    }
}
