<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch 25 users to display in the sidebar
        $users = User::paginate(25); // Assuming you want to display 25 users per page.

        // Return the data to the view
        return view('welcome', compact('users'));
    }
}
