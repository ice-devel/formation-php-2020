<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * Pour injecter l'objet Request de symfony,
     * il suuffit de créer un paramètre dans la fonction
     * et de le type : Request
     * Symfony\Component\HttpFoundation\Request
     */
    public function newPost(Request $request)
    {
        // création du post
        /*
        $post = new Post();
        $post->setDescription("Le post créé par doctrine");
        // on a délégué au prePersist de post cette ligne
        // $post->setCreatedAt(new \DateTime());
        */

        // en passant par un objet form :
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        // on dit au formulaire d'aller dans la requête HTTP les informations
        // l'objet request a été injecté automatiquement dans les paramètres
        // de ce controller
        $form->handleRequest($request);

        // vérifier le formulaire a été soumis
        $message = "";
        if ($form->isSubmitted()) {
            // est-il valide ce form ?
           if ($form->isValid()) {
               // enregistrer en bdd
               $em = $this->getDoctrine()->getManager();
               $em->persist($post);
               $em->flush();
               $message = "Post bien créé";
           }
        }

        /*
        $message = "Le post ".$post->getId(). " a bien été enregistré";
        return new Response($message);
        */

        return $this->render('app/post_new.html.twig', [
            'formPost' => $form->createView(),
            'message' => $message
        ]);
    }

    /**
     * @Route("/edit-post/{id}", name="edit_post")
     */
    public function editPost($id)
    {
        // edition du post
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App:Post')->find($id);

        if ($post == null) {
            throw new NotFoundHttpException();
        }

        /** @var Post $post */
        $post->setDescription("Le post modifié par Doctrine");

        // enregistrer en bdd
        // pas obligé de faire un persist (car doctrine a récupéré cette entité, il la connait déjà)
        // $em->persist($post);
        $em->flush();

        //

        $message = "Le post ".$post->getId(). " a bien été modifié";
        return new Response($message);
    }

    /**
     * @Route("/delete-post", name="delete_post")
     */
    public function deletePost() {
        // récupération de l'entité
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App:Post')->find(2);

        // suppression en bdd
        $em->remove($post);
        $em->flush();

        // après la suppression d'une entité en bdd,
        // la variable continue d'exister mais son ID est setté à NULL

        // si on veut supprimer la variable :
        unset($post);

        $message = "Le post a bien été supprimé";
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

        $em = $this->getDoctrine()->getManager();

        // findBy : mettre des conditions pour récupérer des entités. On peut mettre plusieurs
        // conditions liés par des AND
        $posts = $em->getRepository('App:Post')->findBy([
            'description' => 'Le post créé par doctrine'
        ]);

        // findOneBy : condition pour récupérer une seule entité. Attention si plusieurs
        // entités correspondent en bdd, seule la première sera renvoyé
        $post = $em->getRepository('App:Post')->findOneBy([
            'description' => 'Le post créé par doctrine',
            'id' => 3,
        ]);

        // findOneBy : on peut mettre des OR pour une seule propriété : il suffit de passer
        // un tableau de valeur plutôt qu'une valeur
        $post2 = $em->getRepository('App:Post')->findOneBy([
            'description' => 'Le post créé par doctrine',
            'id' => [1,4,6],
        ]);

        // récupérer les posts qui commence par "le"
        $postsBeginWithLe = $em->getRepository('App:Post')->findPostsBeginWithLe();
        $postBeginWithLe = $em->getRepository('App:Post')->findOnePostBeginWithLe();

        return $this->render('app/index.html.twig', [
            'fname' => $firstname,
            'fnames' => $firstnames,
            'age' => $age,
            'posts' => $posts,
            'post' => $post
        ]);
    }
}
