<?php

namespace App\DataFixtures;

use App\Entity\RatesSource;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ratesSource = new RatesSource;
        $ratesSource->setSource('CBR');
        $ratesSource->setUpdatedAt(DateTimeImmutable::createFromFormat('!d.m.Y', '01.01.2024'));

        $manager->persist($ratesSource);
        $manager->flush();
    }
}
