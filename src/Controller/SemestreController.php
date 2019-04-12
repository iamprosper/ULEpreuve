<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SemestreController extends AbstractController
{
    /**
     * @Route("/semestre", name="semestre")
     */
    public function index()
    {
        return $this->render('semestre/index.html.twig', [
            'controller_name' => 'SemestreController',
        ]);
    }
}
