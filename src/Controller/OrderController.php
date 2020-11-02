<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order_show")
     */
    public function index(): Response
    {
    }

    /**
     * @Route("order/{id}/add", name="order_add")
     */
    public function add() : Response
    {}
}
