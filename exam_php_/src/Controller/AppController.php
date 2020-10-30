<?php

namespace App\Controller;

use App\Repository\TraineeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(TraineeRepository $traineeRepository): Response
    {
        return $this->render('app/index.html.twig', [
            'trainees' => $traineeRepository->findAll(),
        ]);
    }
}
