<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ["name", "rate_value", "rate_count", "year_start", "year_end", "genres", "poster"];

    protected $casts = [
        "genres" => "array"
    ];

    public function reviewServices()
    {
        return $this->belongsToMany(ReviewService::class, 'title_review_service');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'title_user');
    }
}
