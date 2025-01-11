<?php

// app/Http/Controllers/NewsFeedController.php

namespace App\Http\Controllers;

use App\Models\NewsFeed;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsFeedController extends Controller
{
    // Show the form for creating a new news feed post
    public function create()
    {
        return view('news_feed.create');
    }

    // Store a newly created news feed post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048', // Validate image upload
        ]);

        // Handle image upload if present
        $pictureId = null;
        if ($request->hasFile('image')) {
            // Get the uploaded image
            $image = $request->file('image');
            $fileData = file_get_contents($image->getRealPath());
            $fileType = $image->getClientMimeType();

            // Create a new Picture model and store the image as a BLOB
            $picture = new Picture();
            $picture->file_data = $fileData;
            $picture->file_type = $fileType;
            $picture->save();

            // Get the ID of the saved picture
            $pictureId = $picture->id;
        }

        // Create the news feed and associate the picture_id
        $newsFeed = new NewsFeed();
        $newsFeed->title = $request->title;
        $newsFeed->content = $request->content;
        $newsFeed->date = $request->date;
        $newsFeed->picture_id = $pictureId;  // Associate the picture ID with the news feed
        $newsFeed->save();  // Save the news feed with the picture_id

        return redirect()->route('news_feed.news-feed')->with('success', 'News Feed created successfully!');
    }

    public function index()
    {
        // Fetch all the news feed items
        $newsFeed = NewsFeed::latest()->get();

        // Return the view with the news feed
        return view('news_feed.news-feed', compact('newsFeed'));
    }

    public function destroy(NewsFeed $news)
    {
        // Delete the article
        $news->delete();

        // Redirect back to the news feed page with a success message
        return redirect()->route('news_feed.news-feed')->with('success', 'News article deleted successfully!');
    }

    public function edit(NewsFeed $news)
    {
        return view('news_feed.edit', compact('news'));
    }

    // Update the specified news article in the database
    public function update(Request $request, NewsFeed $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',  // Validate image (optional)
        ]);

        // Update the news article
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        // Handle image upload if there is a new image
        if ($request->hasFile('image')) {
            // Get the uploaded image
            $image = $request->file('image');
            $fileData = file_get_contents($image->getRealPath());
            $fileType = $image->getClientMimeType();

            // Create a new Picture model and store the image
            $picture = new Picture();
            $picture->file_data = $fileData;
            $picture->file_type = $fileType;
            $picture->save();

            // Associate the picture with the news article
            $news->picture()->associate($picture);
            $news->save();
        }

        return redirect()->route('news_feed.news-feed')->with('success', 'News article updated successfully!');
    }

    public function show(NewsFeed $news)
    {
        return view('news_feed.show', compact('news'));
    }
};
