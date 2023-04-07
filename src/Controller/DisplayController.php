<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    #[Route('/display', name: 'app_display')]
    public function index(): Response
    {



        return $this->render('display/index.html.twig', [

        ]);
    }
}
