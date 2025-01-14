<?php

// app/Models/NewsFeed.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'date'];

    // Relationship with Picture model
    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_feed_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class); // Assuming 'Order' is the related model
    }
}
