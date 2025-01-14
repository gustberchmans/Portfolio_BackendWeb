<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class MealOrderController extends Controller
{
    public function show($newsId)
    {
        // Fetch the news with comments
        $news = NewsFeed::with('comments')->findOrFail($newsId);

        // Fetch all available meals
        $meals = Meal::all();

        // Pass news and meals to the view
        return view('news.show', ['news' => $news, 'meals' => $meals]);
    }

    // Store the meal order
    public function storeOrder(Request $request, $newsId)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the news item to confirm its existence
        $news = NewsFeed::findOrFail($newsId);

        // Create the order
        $order = Order::create([
            'meal_id' => $request->meal_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::id(), // Assuming the user is logged in
            'news_feed_id' => $newsId, // Add the news_feed_id
        ]);

        return redirect()->route('news.show', $newsId)->with('status', 'Order placed successfully!');
    }

}
