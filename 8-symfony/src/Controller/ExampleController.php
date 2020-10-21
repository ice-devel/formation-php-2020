<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
    /**
     * @Route("/example", name="example")
     */
    public function index()
    {
        $player = new Player();
        $player->setName("Bilbo");

        $team = new Team();
        $team->setName("La communauté de l'anneau");

        //$player->setTeam($team);
        // la bidirectionnalité est gérée dans le addPlayer
        // le setTeam()
        $team->addPlayer($player);

        $em = $this->getDoctrine()->getManager();
        $em->persist($player);
        // $player a une propriété qui est une entité,
        // il faut donc dire à doctrine ce qu'il doit être fait pour
        // cette entité
        // soit vous le dites explicitement :
        // $em->persist($team);

        // soit vous le configurez dans l'entité directement

        $em->flush();

        return $this->render('example/index.html.twig', [
            'controller_name' => 'ExampleController',
        ]);
    }

    /**
     * @Route("/example-team", name="example_team")
     */
    public function team() {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('App:Team')->find(1);

        // récupérer les joueurs de la bdd
        $players = $team->getPlayers();

        // lazy loading : les joueurs sont récupérés en bdd automatiquement
        // dès qu'on en a besoin
        foreach ($players as $player) {
            echo $player->getName();  // HORRIBLE PAS DE ECHO DANS UN CONTROLLER
        }

        return new Response("<body></body>");
    }

    /**
     * @Route("/example-player", name="example_player")
     */
    public function player() {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository('App:Player')->find(1);

        if ($player->getTeam() != null) {
            // lazy loading : on va chercher les informations de la team uniquement
            // quand on a besoin
            echo $player->getTeam()->getName(); // HORRIBLE PAS DE ECHO DANS UN CONTROLLER
        }


        return new Response("<body></body>");
    }


    /**
     * @Route("/example-power", name="example_power")
     */
    public function power() {
        // manyToMany
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository('App:Player')->find(1);
        $powers = $player->getPowers();

        $em = $this->getDoctrine()->getManager();
        $power = $em->getRepository('App:Power')->find(1);
        $players = $power->getPlayers();

        return new Response("<body></body>");
    }
}
