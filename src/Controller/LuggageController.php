<?php

namespace App\Controller;

use App\Entity\Luggage;
use App\Entity\LuggageSearch;
use App\Entity\Reaction;
use App\Form\LuggageSearchType;
use App\Repository\LuggageRepository;
use App\Repository\ReactionRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuggageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("luggage", name="luggage")
     */
    public function index(Request $request,
                          PaginatorInterface $paginator,
                          LuggageRepository $luggageRepository): Response
    {
        $search = new LuggageSearch();
        $form = $this->createForm(LuggageSearchType::class, $search);
        $form->handleRequest($request);


        $paginatedLuggages = $paginator->paginate(
            $luggageRepository->findAllAvailable(),
            $request->query->getInt('page', 1),
            6);


        return $this->render('luggage/index.html.twig', [
            'luggages' => $paginatedLuggages,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("luggage/{id}-{slug}/edit", name="luggage_edit", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function edit(Slugify $slugify, Luggage $luggage ): Response
    {
        return $this->render('luggage/edit.html.twig', [
            'luggage' => $luggage]);
    }

    /**
     * @Route("luggage/{slug}-{id}/show", name="luggage_show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Luggage $luggage
     * @param Slugify $slugify
     * @param LuggageRepository $luggageRepository
     * @return Response
     */
    public function show(string $slug, Luggage $luggage, LuggageRepository $luggageRepository): Response
    {
        if($luggage->getSlug() !== $slug){
            return $this->redirectToRoute('luggage_show', [
                'slug' => $luggage->getSlug(),
                'id' => $luggage->getId()],
                301);
        }
        return $this->render('luggage/show.html.twig', [
            'luggage' => $luggageRepository->find($luggage->getId())
        ]);
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
