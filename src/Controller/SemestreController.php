<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Semestre;
use App\Form\SemestreType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\SemestreRepository;
use Doctrine\Common\Persistence\ObjectManager;



class SemestreController extends AbstractController
{
    /**
     * @Route("/semestre", name="semestre")
     */
    public function index(SemestreRepository  $repo)
    {
    	$semestres = $repo->findAll();
        return $this->render('semestre/index.html.twig', [
            'semestres' => $semestres,
        ]);
    }
    /**
     * @Route("/semestre/create", name="semestre_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
    	$semestre = new Semestre();
    	$form = $this->createForm(SemestreType::class,$semestre);
    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid()){
    		$manager->persist($semestre);
    		$manager->flush();
    		return $this->redirectToRoute('semestre');
    	}
        return $this->render('semestre/create.html.twig', [
            'formSemestre' => $form->createView(),
        ]);
    }
}
