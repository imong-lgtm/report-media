<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Team;
use App\Models\Message;

class AdminController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'services' => Service::count(),
            'projects' => Project::count(),
            'teams' => Team::count(),
            'messages' => Message::count(),
        ];

        $latestMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages'));
    }
}
