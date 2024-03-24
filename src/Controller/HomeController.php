<?php

namespace App\Controller;

use App\Repository\RatesSourceRepository;
use App\Serializer\XmlRateDeserializer;
use App\Service\RatesFetcher;
use App\Service\RatesUpdater;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    #[IsGranted('ROLE_USER')]
    public function index(
        RatesUpdater $ratesUpdater,
        RatesSourceRepository $ratesSourceRepository,
    ): Response {
        $ratesSource = $ratesSourceRepository->findOneBy(['source' => 'CBR']);
        $currentTime = new DateTimeImmutable();

        $timeInterval = $ratesSource->getUpdatedAt()->diff($currentTime);
        $hoursInterval = $timeInterval->h + ($timeInterval->d * 24);

        // Updating exchange rates data if last update was more than 6 hours ago
        if ($hoursInterval >= 6) {
            $rates = $ratesUpdater->update();
        } else {
            $rates = $ratesSource->getRates()->toArray();
        }

        return $this->render(
            'homepage/homepage.html.twig',
            [
                'rates' => $rates
            ]
        );
    }
}
