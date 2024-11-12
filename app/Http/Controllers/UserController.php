<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show the list of users
    public function index()
    {
        $users = User::all(); // Get all users from the database
        return view('admin.users.index', compact('users')); // Return view with users
    }

    // Promote a user to admin
    public function promote(User $user)
    {
        // Ensure only an admin can promote a user
        $user->role = 'admin';
        $user->save();

        return back()->with('status', 'User promoted to admin');
    }

    // Demote a user to regular user
    public function demote(User $user)
    {
        // Ensure only an admin can demote a user
        $user->role = 'user';
        $user->save();

        return back()->with('status', 'User demoted to user');
    }
}
