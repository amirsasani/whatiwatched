<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ImdbService extends BaseService
{
    private $dom;
    private $json_ld;

    public function fetch()
    {
        $response = $this->client()->get($this->url);

        $this->dom = new Crawler($response->body());

        $this->json_ld = $this->dom->filter("script[type='application/ld+json']")->text();
        $this->json_ld = json_decode($this->json_ld, true);

        $imdb_id = $this->getId();
        $poster = $this->getPoster();
        $rating = $this->getRating();
        $genres = $this->getGenres();
        $title = $this->getTitle();
        $years = $this->getYears();


        return compact('imdb_id', 'poster', 'rating', 'genres', 'title', 'years');
    }

    public function getId()
    {
        $id = Str::beforeLast($this->json_ld['url'], '/');
        $id = Str::afterLast($id, '/');

        return $id;
    }

    public function getPoster()
    {
        return $this->json_ld['image'];
    }

    public function getRating()
    {
        $rating = $this->json_ld['aggregateRating'];
        $value = $rating['ratingValue'];
        $count = $rating['ratingCount'];

        return compact('value', 'count');
    }

    public function getGenres()
    {
        $genres = $this->json_ld['genre'];
        return array_map('strtolower', $genres);

    }

    private function titleRegex()
    {
        $title = $this->dom->filter('title')->text();

        $regexes = [
            "/(.*) \((.*)(\d{4}|\?{4})(&nbsp;|–)(\d{4}|).*\)(.*)/",
            "/(.*) \((.*)(\d{4}|\?{4}).*\)(.*)/"
        ];

        foreach ($regexes as $regex) {
            preg_match_all($regex, $title, $x);
            if (!empty($x))
                break;
        }
        return Arr::flatten($x);
    }

    public function getTitle()
    {
        $title_regex = $this->titleRegex();
        return $title_regex[1];
    }

    public function getYears()
    {

        $title_regex = $this->titleRegex();
        $start = $title_regex[3];
        $end = count($title_regex) > 5 ? $title_regex[5] : null;

        $start = !empty($start) ? intval($start) : null;
        $end = !empty($end) ? intval($end) : null;

        return compact('start', 'end');
    }
}
