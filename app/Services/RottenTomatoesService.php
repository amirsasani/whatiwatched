<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class RottenTomatoesService extends BaseService
{
    private $dom;

    public function fetch()
    {
        $response = $this->client()->get($this->url);

        $this->dom = new Crawler($response->body());


        $score = $this->getScore();


        return compact('score');
    }

    public function getScore()
    {
        $score = $this->dom->filter(".score-panel-wrap .critic-score .mop-ratings-wrap__percentage")->text();

        return intval($score);
    }
}
