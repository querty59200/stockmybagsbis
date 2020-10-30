<?php

namespace App\Controller;

use App\Entity\Luggage;
use App\Entity\Reaction;
use App\Repository\LuggageRepository;
use App\Repository\ReactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuggageController extends AbstractController
{
    /**
     * @Route("luggage", name="luggage")
     */
    public function index(LuggageRepository $luggageRepository): Response
    {
        return $this->render('luggage/index.html.twig', [
            'luggages' => $luggageRepository->findAll(),
        ]);
    }

    /**
     * @Route("luggage/{id}/edit", name="luggage_edit")
     */
    public function edit(Luggage $luggage ): Response
    {
        return $this->render('luggage/edit.html.twig', [
            'luggage' => $luggage]);
    }

    /**
     * @Route("luggage/{id}/show", name="luggage_show")
     */
    public function show(Luggage $luggage): Response
    {
        return $this->render('luggage/show.html.twig', [
            'luggage' => $luggage]);
    }

    /**
     * @Route("luggage/{id}/reaction", name="luggage_reaction")
     */
    public function like(Luggage $luggage,
                         EntityManagerInterface $entityManager,
                         ReactionRepository $reactionRepository) : Response
    {
        $user = $this->getUser();

        if(!$user){
            return $this->json([
                'code' => '403',
                'message' => 'Non autorise'
            ],403);
        }

        if($luggage->isLikedByUser($user)){
            $reaction = $reactionRepository->findOneBy([
                'user' => $user,
                'luggage' => $luggage
            ]);

            $entityManager->remove($reaction);
            $entityManager->flush();

            return $this->json([
                'reactions' => $reactionRepository->count([
                    'luggage' => $luggage])
            ], 200);
        } else {

        $reaction = new Reaction();
        $reaction->setUser($user);
        $reaction->setLuggage($luggage);

        $entityManager->persist($reaction);
        $entityManager->flush();

        return $this->json([
            'reactions' => $reactionRepository->count([
                'luggage' => $luggage])
            ],200);
        }
    }
}
