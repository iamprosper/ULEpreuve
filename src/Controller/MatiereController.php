<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use App\Repository\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Matiere;

class MatiereController extends AbstractController
{
    /**
     * @Route("/matiere", name="matiere")
     */
    public function index(DepartementRepository $repo)
    {
        //Je récupère la liste de départements
    	$departements = $repo->findAll();

        //Je récupère le nombre de matières
        $nMatieres = count($repo->findAll());

        //Je renvoie la vue composée des différents départements et du nombre de matières
        return $this->render('matiere/index.html.twig', [
            'departements' => $departements,
            'nMatieres' => $nMatieres
        ]);
    }

    /**
     * @Route("/matiere/create", name="matiere_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
    	$matiere = new Matiere();
    	$form = $this->createForm(MatiereType::class,$matiere);
    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid()){
    		$manager->persist($matiere);
    		$manager->flush();
    		return $this->redirectToRoute('matiere');
    	}
        return $this->render('matiere/create.html.twig', [
            'formMatiere' => $form->createView()
        ]);
    }

}
