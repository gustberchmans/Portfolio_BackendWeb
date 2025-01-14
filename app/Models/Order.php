<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id',
        'quantity',
        'user_id',
        'news_feed_id', // Add this to allow mass assignment
    ];
    // In Order model
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsFeed()
    {
        return $this->belongsTo(NewsFeed::class, 'news_feed_id', 'id'); // The foreign key is 'news_feed_id'
    }

}
