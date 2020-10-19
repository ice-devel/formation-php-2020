<?php

namespace App\Controller;

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
        $response = new Response();
        $response->setContent("Hello");

        return $response;
    }

    /**
     * @Route("/prout", name="prout")
     */
    public function prout()
    {
        $response = new Response();
        $response->setContent("<html>
                        <head></head>
                        <body>Prout</body>
                    </html>");

        return $response;
    }

}
