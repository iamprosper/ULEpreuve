<?php

namespace App\Controller;

use App\Entity\Affiche;
use App\Form\AfficheType;
use App\Entity\AfficheFile;
use App\Repository\AfficheRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AfficheController extends AbstractController
{
    /**
     * @Route("/affiche", name="affiche")
     */
    public function index(AfficheRepository $affiche, Request $request, ObjectManager $manager)
    {
        $info = new Affiche();
        $form = $this->createForm(AfficheType::class,$info);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // $uploads_dir = $this->getParameter('archives_directory');
            $files = $form['fichiers']->getData();
            foreach ($files as $file) {
                $afficheFile = new AfficheFile();
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                $file->move('uploads/archives',$filename);
                $afficheFile->setNom($filename);
                $manager->persist($afficheFile);
                $info->addFichier($afficheFile);
            }
            $info->setAuteur($this->getUser());
            $manager->persist($info);
            $manager->flush();
        }
        $affiches = $affiche->findAll();
        return $this->render('affiche/index.html.twig', [
            'affiches' => $affiches,
            'form'=>$form->createView(),
        ]);
    }
}
