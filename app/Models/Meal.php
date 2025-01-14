<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    // If you have a pivot table with user orders, define the relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class, 'orders')->withPivot('quantity')->withTimestamps();
    }
}
