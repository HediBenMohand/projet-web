<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

class GameAdminController extends AbstractController
{

    /**
     * @Route("/admin/game/new")
     */
    public function new(EntityManagerInterface $em)
    {
        $Game = new Game();
        $Game->setTitle('Why Asteroids Taste Like Bacon')
            ->setSlug('What a nouveau jeux-'.rand(100, 999));
            

        $em->persist($Game);
        $em->flush();
        
        return new Response(sprintf(
            'Hiya! New Game id: #%d slug: %s',
            $Game->getId(),
            $Game->getSlug()
        ));
    }

    /**
     * @Route("/game/admin", name="game_admin")
     */
    public function index()
    {
        return $this->render('game_admin/index.html.twig', [
            'controller_name' => 'GameAdminController',
        ]);
    }
}
