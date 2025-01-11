<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin) {
            abort(403, 'Unauthorized access');
        }

        $users = User::all(); // Fetch all users
        return view('users.index', compact('users'));
    }

    public function toggleAdmin(\App\Models\User $user, Request $request)
    {
        $user->isAdmin = !$user->isAdmin;
        $user->save();

        return back()->with('success', 'User admin status updated successfully.');
    }

    public function show(User $user)
    {
        // Return the view with the user data
        return view('users.profile', compact('user'));
    }
}


