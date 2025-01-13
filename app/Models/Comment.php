<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['news_id', 'author', 'content'];

    // Relationship with news
    public function news()
    {
        return $this->belongsTo(NewsFeed::class, 'news_feed_id');
    }
}

