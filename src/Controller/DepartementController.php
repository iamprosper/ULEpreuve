<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Departement;
// use App\Entity\Etablissement;
use App\Repository\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\DepartementType;

class DepartementController extends AbstractController
{
    /**
     * @Route("/departement", name="departement")
     */
    public function index(DepartementRepository $repo)
    {
        // $repoEt = $this->getDoctrine()->getRepository(Etablissement::class);
        $departements = $repo->findAll();
        return $this->render('departement/index.html.twig', [
            'departements'=> $departements
        ]);
    }

    /**
    * @Route("/departement/create", name="departement_create")
    */
    public function create(Request $request, ObjectManager $manager){
    	$departement = new Departement();
    	// $form = $this->createFormBuilder($departement)
		   //  		->add('libelle')
					// ->add('etablissement')
					// ->getForm();
					
        $form = $this->createForm(DepartementType::class,$departement);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($departement);
            $manager->flush();
        }
    	return $this->render('departement/create.html.twig',[
    		'formDepartement'=>$form->createView()
		]);
    }
}
