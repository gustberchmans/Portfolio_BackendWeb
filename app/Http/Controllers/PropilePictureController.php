<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilePictureController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Get the file content as a blob
        $file = $request->file('profile_picture');
        $blobData = file_get_contents($file);

        // Save to the database
        $profilePicture = $user->profilePicture ?? new ProfilePicture(['user_id' => $user->id]);
        $profilePicture->image_blob = $blobData;
        $profilePicture->file_name = $file->getClientOriginalName();
        $profilePicture->file_size = $file->getSize();
        $profilePicture->file_type = $file->getMimeType();
        $profilePicture->save();

        return back()->with('status', 'Profile picture updated successfully!');
    }
}

