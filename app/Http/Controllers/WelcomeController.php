<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NewsFeed;

class WelcomeController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);

        // Fetch 25 users to display in the sidebar
        $newsFeed = NewsFeed::latest()->take(5)->get();

        // Pass both users and news feed data to the view
        return view('welcome', compact('users', 'newsFeed'));
    }
}
