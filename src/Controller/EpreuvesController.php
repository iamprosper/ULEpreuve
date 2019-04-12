<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EpreuvesController extends AbstractController
{
    /**
     * @Route("/epreuves", name="epreuves")
     */
    public function index()
    {
        return $this->render('epreuves/index.html.twig', [
            'controller_name' => 'EpreuvesController',
        ]);
    }
}
