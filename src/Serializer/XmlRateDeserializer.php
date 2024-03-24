<?php

namespace App\Serializer;

use App\Dto\RateDto;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class XmlRateDeserializer
{
    public function deserialize(string $rawXmlData)
    {
        $serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], []);
        $decoder = new XmlEncoder();
        $decodedData = $decoder->decode($rawXmlData, 'xml');
        $decodedData['Valute'] = $serializer->denormalize($decodedData['Valute'], RateDto::class . '[]', 'xml');

        // Adding ruble to exchange rates from CBR
        $ruble = new RateDto;
        $ruble->setCharCode('RUB');
        $ruble->setVunitRate('1');
        $decodedData['Valute'][] = $ruble;
        return $decodedData;
    }
}
