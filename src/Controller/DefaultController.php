<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function secretAction()
    {
        return new Response(
            '<html><body>SECRET ROUTE</body></html>'
        );
    }

    /**
     * @Route("/HelloWorld", name="helloworld")
     */
    public function hellowordAction()
    {
        return new Response(
            '<html><body>HELLO WORLD</body></html>'
        );
    }

    /**
     * Tata toto ceci ne sera pas lu par le serveur
     * @Route("/character", name="character")
     * @Route("/character/{id}", name="character_id")
     */
    public function characterAction($id = 0)
    {
        $player1 = (object) [
            'name' => 'Roger',
            'hp' => 0,
            'maxhp' => 100,
            'class' => 'Warrior',
        ];

        $player2 = (object) [
            'name' => 'Robert',
            'hp' => 0,
            'maxhp' => 60,
            'class' => 'Mage',
        ];

        $player3 = (object) [
            'name' => 'Remy',
            'hp' => 0,
            'maxhp' => 80,
            'class' => 'Thief',
        ];

        $player1->hp = rand(0,$player1->maxhp);
        $player2->hp = rand(0,$player2->maxhp);
        $player3->hp = rand(0,$player3->maxhp);

        $players = [$player1, $player2, $player3];

        return $this->render('default/character.html.twig', [
            'player' => $players[(($id + 1 > count($players)) || ($id < 0)) ? 0 : $id],
            'error' => (($id + 1 > count($players)) || ($id < 0)) ? "Ce personnage n'existe pas !" : null,
        ]);
    }
}