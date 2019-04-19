<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Epreuves;
use App\Repository\EpreuvesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EpreuveType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EpreuvesController extends AbstractController
{
    /**
     * @Route("/epreuves", name="epreuves")
     */
    public function index(EpreuvesRepository $repo)
    {
    	$epreuves = $repo->findAll();
        return $this->render('epreuves/index.html.twig', [
            'epreuves' =>  $epreuves
        ]);
    }
 	/**
     * @Route("/epreuves/create", name="epreuves_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        //On crée une nouvelle instance d'épreuves
    	$epreuve = new Epreuves();

        //On crée  un formulaire contenant les différents champs à renseigner
    	$form = $this->createForm(EpreuveType::class, $epreuve);

        //On analyse la requête
    	$form->handleRequest($request);

        //On fait les traitements sur le formulaire envoyé
    	if($form->isSubmitted() && $form->isValid()){
            /**
            * @var 
            */
            //Je récupère le fichier ajouté
            $file = $form['file']->getData();
            dump($file);

            //Je récupère son nom et son extension
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            //Je le sauvegarde dans le dossier des uploads
            try{
                $file->move(
                    $this->getParameter('epreuves_directory'),
                    $fileName
                );
            }catch(FileException $fe){

            }

            $epreuve->setFile($fileName);
            //Je prépare la requête d'injection des données dans la base
    		$manager->persist($epreuve);

            //J'injecte les données dans la base
    		$manager->flush();

            //Je redirige l'utilisateur vers la liste d'épreuves
    		return $this->redirectToRoute('epreuves');
    	}

        //Je redirige l'utilisateur vers la page de formulaire
        return $this->render('epreuves/create.html.twig', [
            'formEpreuve' => $form->createView()
        ]);
    }

    //Cette fonction permet de générer le nom de mon fichier
    /**
    * @return string
    */
    private function generateUniqueFileName(){
        return md5(uniqid());
    }
}
