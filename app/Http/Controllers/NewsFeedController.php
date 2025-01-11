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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validate image upload
        ]);

        // Handle image upload if present
        $pictureId = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $picture = Picture::create(['path' => $imagePath]);
            $pictureId = $picture->id;
        }

        // Create the news feed
        NewsFeed::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
            'picture_id' => $pictureId,
        ]);

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
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
        ]);

        // Update the news article with the new values
        $news->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'date' => $request->input('date'),
        ]);

        // Redirect back to the news feed with a success message
        return redirect()->route('news_feed.news-feed')->with('success', 'News article updated successfully!');
    }
}
