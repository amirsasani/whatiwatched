<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class BaseService
{

    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param array|null $headers
     * @return PendingRequest
     */
    protected function client(array $headers = null): PendingRequest
    {
        return Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0',
            'From' => 'youremail@domain.com',
            'Referer' => 'https://www.imdb.com/',
            'Cookie' => 'beta-control=""',
            'Accept-Language' => 'en-US,en;q=0.5',
        ]);
    }

    abstract public function fetch();
}
