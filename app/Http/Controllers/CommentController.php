<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use App\Models\User;

class CommentController extends Controller
{
    public function store(Request $request, NewsFeed $news)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        $news->comments()->create([
            'author' => $request->author,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('news-feed.show', $news->id)->with('success', 'Comment added successfully.');
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
            'content' => $request->input('content'),
        ]);

        return redirect()->route('users.show', $user->id)->with('success', 'Comment added successfully.');
    }
}

