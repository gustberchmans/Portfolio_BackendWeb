<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display the list of users with a checkbox to edit their isAdmin status
    public function index()
    {
        $users = User::all();  // Get all users
        return view('admin-dashboard', compact('users'));
    }

    // Update the isAdmin status of a user
    public function update(Request $request, User $user)
    {
        // Validate if the logged-in user is an admin
        $request->validate([
            'isAdmin' => 'required|boolean',
        ]);

        // Update the user's isAdmin status
        $user->isAdmin = $request->input('isAdmin');
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User admin status updated!');
    }

    public function update(Request $request, $userId)
    {
        // Find the user by their ID
        $user = User::findOrFail($userId);

        // Validate the 'isAdmin' checkbox
        $request->validate([
            'isAdmin' => 'required|boolean',
        ]);

        // Update the user's isAdmin status
        $user->isAdmin = $request->input('isAdmin');
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User admin status updated!');
    }

    // In AdminController or whatever controller handles the admin dashboard
    public function showAdminDashboard()
    {
        // Fetch all users (or you can apply filters based on your requirement)
        $users = User::all();

        // Return the admin dashboard view with the users data
        return view('admin-dashboard', compact('users'));
    }

}
