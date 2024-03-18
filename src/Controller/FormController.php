<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormController extends AbstractController
{

    #[Route('/form', name: 'form')]
    public function index(): Response
    {
        return $this->render('pages/form.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }

    
}
