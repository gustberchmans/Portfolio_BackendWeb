<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = \App\Models\User::all();
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


