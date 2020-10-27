<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\Post1Type;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        // récupérer un paramètre défini dans services.yaml
        $this->getParameter('email_sender');

        /*
        $post = new Post();
        $post->setDescription("Mon premier post dynamique");
        $post->setCreatedAt(new \DateTime());
        */

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
        //$posts = $postRepo->findAll();
        // récup tous les posts du plus récent au plus vieux
        // $posts = $postRepo->findAllByInversedOrder();

        // ou encore avec l'une des méthodes fournies par le repo
        $posts = $postRepo->findBy([], ['createdAt' => 'DESC']);

        $post = new Post();
        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('new_post_confirm')
        ]);

        return $this->render('app/homepage.html.twig', [
            //'post' => $post,
            'posts' => $posts,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new-post", name="new_post")
     * Pour injecter l'objet Request de symfony,
     * il suffit de créer un paramètre dans la fonction
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
        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('new_post_confirm')
        ]);

        return $this->render('app/post_new.html.twig', [
            'formPost' => $form->createView()
        ]);
    }

    /**
     * @Route("/new-post/confirmation", name="new_post_confirm")
     */
    public function newPostConfirm(Request $request) {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        // on dit au formulaire d'aller dans la requête HTTP les informations
        // l'objet request a été injecté automatiquement dans les paramètres
        // de ce controller
        $form->handleRequest($request);

        // vérifier le formulaire a été soumis
        // est-il valide ce form ?
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // enregistrer en bdd
                $em = $this->getDoctrine()->getManager();

                // récupérer l'utilisateur qui est connecté :
                $post->setUser($this->getUser());

                // est-ce que on active le post ? si on est admin oui, sinon non
                if ($this->isGranted('ROLE_ADMIN')) {
                    $post->setIsEnabled(true);
                }
                else {
                    $post->setIsEnabled(false);
                }

                $em->persist($post);
                $em->flush();

                // je crée le html correspondant au nouveau post
                // pour le renvoyer au navigateur
                $viewPost = $this->renderView('app/_one_post.html.twig', [
                    'p' => $post
                ]);

                // on répond au navigateur : on répond en json pour pouvoir plusieurs
                // informations
                return new JsonResponse([
                    'code' => 0,
                    'template' => $viewPost
                ]);
            }
            else {
                //$this->addFlash('danger', 'Ton post doit avoir min. 20 caractères');
                //$referer = $request->headers->get('referer');
                //return $this->redirect($referer);
                $viewForm = $this->renderView('app/_form_new_post.html.twig', [
                    'formPost' => $form->createView()
                ]);

                return new JsonResponse([
                    'code' => -1,
                    'template' => $viewForm
                ]);
            }
        }

        return new Response("T'avais pas le droit de visiter cette page directement.");
    }

    /**
     * @Route("/edit-post/{id}", name="edit_post")
     */
    public function editPost($id, Request $request)
    {
        // edition du post
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App:Post')->find($id);

        if (!$post instanceof Post) {
            throw new NotFoundHttpException();
        }

        // est-ce que la personne connectée a le droit de modifier ce post ?
        // ceci va déclencher la vérification des Voter qui prennent en charge les entités Post
        $this->denyAccessUnlessGranted('POST_EDIT', $post);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer en bdd
            // pas obligé de faire un persist (car doctrine a récupéré cette entité, il la connait déjà)
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('app/post_edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete-post", name="delete_post")
     */
    public function deletePost() {
        // récupération de l'entité
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App:Post')->find(2);

        $this->denyAccessUnlessGranted('POST_DELETE', $post);

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
