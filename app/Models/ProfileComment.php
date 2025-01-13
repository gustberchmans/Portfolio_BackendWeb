<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileComment extends Model
{
    protected $fillable = ['user_id', 'author', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class); // Each comment belongs to a user
    }
}
