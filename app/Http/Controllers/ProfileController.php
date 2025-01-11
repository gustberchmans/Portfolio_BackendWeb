<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\ProfilePicture;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();  // Get the logged-in user
        $profilePicture = $user->profilePicture;  // Use the relationship to get the profile picture

        return view('profile.edit', [
            'user' => $user,
            'profilePicture' => $profilePicture,  // Pass profilePicture to the view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate all fields
        $request->validate([
            'birthday' => 'nullable|date',
            'about' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the user fields
        $user->birthday = $request->input('birthday', $user->birthday);
        $user->about = $request->input('about', $user->about);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Convert the image file into binary data
            $fileData = file_get_contents($file->getRealPath());

            // Save the image metadata and binary data in the 'profile_pictures' table
            $profilePicture = ProfilePicture::updateOrCreate(
                ['user_id' => auth()->id()], // Find the profile picture by the user ID
                [
                    'file_data' => $fileData,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                ]
            );
        }

        // Save updated user data
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
