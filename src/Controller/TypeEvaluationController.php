<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeEvaluationController extends AbstractController
{
    /**
     * @Route("/type/evaluation", name="type_evaluation")
     */
    public function index()
    {
        return $this->render('type_evaluation/index.html.twig', [
            'controller_name' => 'TypeEvaluationController',
        ]);
    }
}
