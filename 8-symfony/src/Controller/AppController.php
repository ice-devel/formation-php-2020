<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index()
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
