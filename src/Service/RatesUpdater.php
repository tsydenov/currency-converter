<?php

namespace App\Service;

use App\Mapper\CBRFRateMapper;
use App\Repository\RateRepository;
use App\Repository\RatesSourceRepository;
use App\Serializer\XmlRateDeserializer;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class RatesUpdater
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RatesFetcher $ratesFetcher,
        private XmlRateDeserializer $rateDeserializer,
        private RatesSourceRepository $ratesSourceRepository,
        private RateRepository $rateRepository,
        private CBRFRateMapper $rateMapper
    ) {
    }

    public function update()
    {
        $rawRates = $this->ratesFetcher->fetch();
        $rates = $this->rateDeserializer->deserialize($rawRates);
        $rates = $this->rateMapper->map($rates);
        $this->rateRepository->saveAll($rates);

        $source = $this->ratesSourceRepository->findOneBy(['source' => 'CBR']);
        $source->setUpdatedAt(new DateTimeImmutable());

        $this->entityManager->flush();

        return $rates;
    }
}
