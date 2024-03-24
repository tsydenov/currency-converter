<?php

namespace App\Mapper;

use App\Entity\Rate;
use App\Entity\RatesSource;
use App\Repository\RatesSourceRepository;
use DateTimeImmutable;

class CBRFRateMapper
{
    public function __construct(
        private RatesSourceRepository $ratesSourceRepository
    ) {
    }

    public function map(array $data): array
    {
        $rates = [];
        foreach ($data['Valute'] as $rateDto) {
            $rate = new Rate;
            $rate->setQuote('RUB');
            $rate->setBase($rateDto->getCharCode());
            $rate->setPrice(str_replace(',', '.', $rateDto->getVunitRate()));
            $date = DateTimeImmutable::createFromFormat('!d.m.Y', $data['@Date']);
            $rate->setDate($date);
            $cbrSource = $this->ratesSourceRepository->findOneBy(['source' => 'CBR']);
            $rate->setRatesSource($cbrSource);
            $rates[] = $rate;
        }
        return $rates;
    }
}
