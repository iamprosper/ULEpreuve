<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
    /**
     * @Route("utilisateur/ajout", name="utilisateur_add")
     */
    public function ajouter(Request $request, ObjectManager $objectmanger, UserPasswordEncoderInterface $encoder)
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $objectmanger->persist($user);
            $objectmanger->flush();
            return $this->redirectToRoute('login');

        }
        return $this->render('utilisateur/registration.html.twig', [
            'controller_name' => 'UtilisateurController',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/connexion", name="login")
     */
    public function login(){
        return $this->render('utilisateur/login.html.twig');
    }
    /**
     * @Route("/deconnexion", name="logout")
     */
    public function logout(){}
}
