<?php

namespace Database\Seeders;

use App\Models\ReviewService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviewServices = [
            ["name" => "Rotten Tomatoes", "logo" => asset("assets/imgs/rotten-tomatoes-logo.png")],
            ["name" => "Metacritic", "logo" => asset("assets/imgs/metacritic-logo.png")]
        ];

        foreach ($reviewServices as $reviewService){
            ReviewService::create($reviewService);
        }
    }
}
