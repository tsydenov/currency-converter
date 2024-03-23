<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    #[IsGranted('ROLE_USER')]
    public function homepage(): Response
    {
        return $this->render('homepage/homepage.html.twig');
    }
}
