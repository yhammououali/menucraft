<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/copyright', name: 'menucraft_copyright', methods: ['GET'])]
    public function copyright(): Response
    {
        return $this->render('legal/copyright.html.twig');
    }
}