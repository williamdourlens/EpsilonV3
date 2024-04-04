<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RegisterController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]
    public function index(): Response
    {
        return $this->render('pages/register/index.html.twig');
    }

    #[Route('/registerVerification', name: 'app_registerVerification')]
    public function registerVerification(Request $request, EntityManagerInterface $entityManager): Response
    {
        $email = $request->request->get('mail');
        $password = $request->request->get('password');
        $pseudo = $request->request->get('pseudo');
        
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setPseudo($pseudo);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('pages/register/success.html.twig', [
                'error' => 'Inscription réussie',
            ]);
        }
        else {
            return $this->render('pages/register/fail.html.twig', [
                'error' => 'Cette adresse email est déjà utilisée',
            ]);
        }
    }
}
