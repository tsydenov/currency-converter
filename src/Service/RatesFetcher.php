<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RatesFetcher
{
    public function __construct(
        private HttpClientInterface $httpClient
    ) {
    }

    public function fetch(): string
    {
        $rawData = $this->httpClient->request(
            'GET',
            'http://www.cbr.ru/scripts/XML_daily.asp'
        )->getContent();
        return $rawData;
    }
}
