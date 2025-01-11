<?php

namespace App\Http\Controllers;

use App\Models\NewsFeed;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard (Admin Redirect).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        // If the user is an admin, redirect them to the admin dashboard
        if ($user->isAdmin) {
            return redirect()->route('admin.dashboard');
        }

        // Use the WelcomeController to fetch users
        $welcomeController = new WelcomeController();
        $users = $welcomeController->index()->getData()['users']; // Fetch users (assuming 25 users per page)

        // Fetch the latest 5 news items for the news feed
        $newsFeed = NewsFeed::latest()->take(5)->get();

        // Pass both users and newsFeed to the view
        return view('dashboard', compact('users', 'newsFeed'));
    }

    /**
     * Method to display the dashboard with news and users.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDashboard()
    {
        // Fetch the latest 5 news items for the news feed
        $newsFeed = NewsFeed::latest()->take(5)->get();

        // Fetch users using WelcomeController
        $welcomeController = new WelcomeController();
        $users = $welcomeController->index()->getData()['users'];

        // Pass both users and newsFeed to the view
        return view('dashboard', compact('users', 'newsFeed'));
    }
}
