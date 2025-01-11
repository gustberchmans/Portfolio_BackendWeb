<?php

// app/Models/NewsFeed.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'date', 'picture_id'];

    // Relationship with Picture model
    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }
}
