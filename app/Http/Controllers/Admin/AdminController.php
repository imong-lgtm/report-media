<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Message;

class AdminController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'articles' => Article::count(),
            'categories' => Category::count(),
            'messages' => Message::count(),
        ];

        $latestMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages'));
    }
}
