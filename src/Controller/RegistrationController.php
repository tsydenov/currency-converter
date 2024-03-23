<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/signup', name: 'app_signup')]
    public function signUp(): Response
    {
        return $this->render('auth/registration.html.twig');
    }

    #[Route('/signup', name: 'app_createuser', methods: ['POST'])]
    public function createNewUser(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        $user = new User;
        $user->setUsername($request->request->get('username'));
        $user->setPassword($userPasswordHasher->hashPassword(
            $user,
            $request->request->get('password')
        ));

        $entityManager->persist($user);
        $entityManager->flush();

        return new RedirectResponse('/login');
    }
}
