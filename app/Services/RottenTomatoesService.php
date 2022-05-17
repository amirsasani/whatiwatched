<?php

namespace App\Services;


class RottenTomatoesService extends BaseService
{
    private $json_ld;

    public function fetch()
    {
        $response = $this->client()->get($this->url);

        preg_match('#<script type="application/ld\+json">(.+?)</script>#ims', $response->body(), $matches);
        $this->json_ld = json_decode($matches[1], true);

        $score = $this->getScore();
        $reviews = $this->getReviews();

        return compact('score', 'reviews');
    }

    public function getScore()
    {
        $score = $this->json_ld['aggregateRating']['ratingValue'];
        return intval($score);
    }

    public function getReviews()
    {
        $reviews = $this->json_ld['aggregateRating']['ratingCount'];

        return intval($reviews);
    }
}
