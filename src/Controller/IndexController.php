<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'form')]
    public function form(): Response
    {
        return $this->render('pages/Form.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }

    #[Route('/Home', name: 'index')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
