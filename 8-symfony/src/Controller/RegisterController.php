<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="user_create")
     */
    public function create(Request $request, UserManager $userManager)
    {
       $user = new User();
       $form = $this->createForm(UserType::class, $user);

       $form->handleRequest($request);

       if ($form->isSubmitted()) {
           // $form->isValid vérifie si le formulaire est valide :
           // ça veut qu'on checke les validations de l'entité
           if ($form->isValid()) {
               $user->setPlainPassword($form->get('plainPassword')->getData());
               $confirmOrNot = $form->get('mailConfirmOrNot')->getData();
               $userManager->insert($user);

               // message flash : passer un message d'une page à une autre
               $this->addFlash('success', 'Merci, inscription prise en compte.');

               // rediriger pour éviter d'afficher le formulaire à nouveau
               // rempli avec les mêmes informations
               return $this->redirectToRoute('app_login');
           }
       }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
