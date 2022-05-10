<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewService extends Model
{
    use HasFactory;

    protected $fillable = ["name", "logo"];

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'title_review_service');
    }
}
