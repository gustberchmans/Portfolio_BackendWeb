<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    // Relationship with NewsFeed model
    public function newsFeeds()
    {
        return $this->hasMany(NewsFeed::class);
    }
}
