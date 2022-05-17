<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ["imdb_url", "slug", "name", "rate_value", "rate_count", "year_start", "year_end", "genres", "poster"];

    protected $casts = [
        "genres" => "array"
    ];

    public function reviewServices()
    {
        return $this->belongsToMany(ReviewService::class, 'title_review_service')
            ->withPivot(['url', 'score', 'count']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'title_user');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
