<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::take(3)->get();
        $projects = Project::latest()->take(3)->get();
        $teams = Team::all();
        return view('home', compact('services', 'projects', 'teams'));
    }

    public function about()
    {
        return view('about');
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
