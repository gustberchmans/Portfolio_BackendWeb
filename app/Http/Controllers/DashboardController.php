<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin) { // Assuming `isAdmin` is a boolean attribute in the `users` table
            return redirect()->route('admin.dashboard');
        }

        $users = User::paginate(25);

        // Return the view with users data
        return view('dashboard', compact('users'));
    }
}
