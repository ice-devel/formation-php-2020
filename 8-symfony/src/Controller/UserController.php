<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('App:User')->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/create", name="user_create")
     */
    public function create(Request $request)
    {
       $user = new User();
       $form = $this->createForm(UserType::class, $user);

       $form->handleRequest($request);

       if ($form->isSubmitted()) {
           // $form->isValid vérifie si le formulaire est valide :
           // ça veut qu'on checke les validations de l'entité
           if ($form->isValid()) {
               $em = $this->getDoctrine()->getManager();
               $em->persist($user);
               $em->flush();

               // message flash : passer un message d'une page à une autre
               $this->addFlash('success', 'Merci, inscription prise en compte.');

               // rediriger pour éviter d'afficher le formulaire à nouveau
               // rempli avec les mêmes informations
               return $this->redirectToRoute('user');
           }
       }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
