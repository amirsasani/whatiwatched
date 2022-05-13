<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class MetacriticService extends BaseService
{
    private $dom;

    public function fetch()
    {
        $response = $this->client()->get($this->url);

        $this->dom = new Crawler($response->body());


        $score = $this->getScore();
        $reviews = $this->getReviews();


        return compact('score', 'reviews');
    }

    public function getScore()
    {
        $score = $this->dom->filter(".metascore_w.larger.tvshow.positive")->text();

        return intval($score);
    }

    public function getReviews()
    {
        $reviews = $this->dom->filter(".score_details .score_description .based_on")->text();
        $reviews = filter_var($reviews, FILTER_SANITIZE_NUMBER_INT);

        return intval($reviews);
    }
}
