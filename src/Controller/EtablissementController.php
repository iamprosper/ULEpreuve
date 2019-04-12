<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\EtablissementType;



class EtablissementController extends AbstractController
{
    /**
     * @Route("/etablissement", name="etablissement")
     */
    public function index(EtablissementRepository $repo)
    {
        $etablissements = $repo->findAll();
        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }
    /**
     * @Route("/etablissement/create", name="etablissement_create")
     */

    public function create(Request $request,ObjectManager $manager ){
    	//On cré
    	$etablissement = new Etablissement();
    	// $form = $this->createFormBuilder($etablissement)
    	// 			->add('libelle')
    	// 			->getForm();
    	$form = $this->createForm(EtablissementType::class,$etablissement);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$manager->persist($etablissement);
			$manager->flush();
		}
		
		return $this->render('etablissement/create.html.twig',[
			'formEtablissement'=>$form->createView()
		]);
    }
}
