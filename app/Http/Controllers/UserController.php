<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot remove your own admin status.');
        }

        $user->isAdmin = !$user->isAdmin;
        $user->save();

        return back()->with('success', 'User admin status updated successfully.');
    }

    public function show(User $user)
    {
        $user = User::with('comments')->findOrFail($user->id);
        return view('users.profile', compact('user'));
    }

    public function destroy(User $user)
    {
        // Ensure the user cannot delete themselves (optional)
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        // Delete the user
        $user->delete();

        // Redirect with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function create()
    {
        return view('users.create'); // This should return the view for creating a user
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'isAdmin' => 'nullable|boolean',
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->has('isAdmin') ? true : false, // Set admin status if checked
        ]);

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    public function storeComment(Request $request, $userId)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        $user = User::findOrFail($userId);

        // Create a new comment
        $user->comments()->create([
            'author' => $request->author,
            'content' => $request->content,
        ]);

        return redirect()->route('users.profile', $userId)->with('status', 'Comment added!');
    }
}


