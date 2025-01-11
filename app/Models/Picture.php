<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['file_data', 'file_type'];

    // Define the relationship to the News model
    public function news()
    {
        return $this->belongsTo(NewsFeed::class);
    }
}
