<?php

namespace App\Controller;

use App\Repository\LuggageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(LuggageRepository $luggageRepository): Response
    {
        return $this->render('luggage/index.html.twig', [
            'luggages' => $luggageRepository->findAll()
        ]);
    }
}
