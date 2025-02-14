<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'menucraft_homepage', methods: ['GET'])]
    public function index(): Response
    {
        /* return $this->json([
            'message' => 'Welcome to the homepage!',
            'status' => 'success',
        ]);*/

        return $this->render('homepage.html.twig');
    }
}
