<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $post = new Post();
        $post->setDescription("Mon premier post dynamique");
        $post->setCreatedAt(new \DateTime());

        /*
        $post1 = new Post();
        $post1->setDescription("Descrption du post1");
        $post1->setCreatedAt(new \DateTime());

        $post2 = new Post();
        $post2->setDescription("Descrption du post2");
        $post2->setCreatedAt(new \DateTime());
        $posts = [$post1, $post2];
        */

        // récupération de tous les posts en bdd
        $em = $this->getDoctrine()->getManager();
        // récupérer le repository associé à l'entité
        $postRepo = $em->getRepository('App:Post');
        // récup tous les entités
        $posts = $postRepo->findAll();


        return $this->render('app/homepage.html.twig', [
            'post' => $post,
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/new-post", name="new_post")
     */
    public function newPost()
    {
        // création du post
        $post = new Post();
        $post->setDescription("Le post créé par doctrine");
        $post->setCreatedAt(new \DateTime());

        // enregistrer en bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        $message = "Le post ".$post->getId(). " a bien été enregistré";
        return new Response($message);
    }

    /**
     * @Route("/twig", name="twig")
     */
    public function twig()
    {
        $firstname = "Bidule";
        $firstnames = ['Toto', 'Tata', 'Titi'];
        $age = 30;

        return $this->render('app/index.html.twig', [
            'fname' => $firstname,
            'fnames' => $firstnames,
            'age' => $age
        ]);
    }
}
