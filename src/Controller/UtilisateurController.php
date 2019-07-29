<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            'utilisateur' => 'UtilisateurController',
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
            $user->setConfirmPassword($user->getPassword());
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
     * @Route("/edition", name="edition")
     */
    public function editer(Request $request,ObjectManager $objectmanger,UserPasswordEncoderInterface $encoder){
        $user = $this->getUser();
        $form = $this->CreateFormBuilder($user)
                    ->add('username',TextType::class)
                    ->add('email', EmailType::class)
                    ->add('nom', TextType::class)
                    ->add('prenom',TextType::class)
                    ->add('sexe',ChoiceType::class,[
                        'choices' => [
                            'Homme' => true,
                            'Femme' => false,
                        ]
                    ])
                    ->add('dateNaissance', DateType::class)
                    ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setConfirmPassword($user->getPassword());
            $objectmanger->persist($user);
            $objectmanger->flush();
            return $this->redirectToRoute('profilUser');
        }
        return $this->render('utilisateur/editer.html.twig', [
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
     * @Route("/profilUser", name="profilUser")
     */
    public function profilUser()
    {
        $user = $this->verifier();
        return $this->render('utilisateur/detail.html.twig', [
            'utilisateur' => $user,
        ]);
    }
    public function verifier(){
        return $this->getUser();
    }
    
    /**
     * @Route("/deconnexion", name="logout")
     */
    public function logout(){}
    /**
     * @Route("/suppression", name="suppression")
     */
    public function suppresion(ObjectManager $objectmanger, UtilisateurRepository $userRep){
       $user = $this->getUser();
       $id = $user->getId();
       if ($id)
       {
         $session = $this->get('session');
         $session = new Session();
         $session->invalidate();
       }
        $user = $userRep->find($user = $id);
        $user = $userRep->find($id);
        $objectmanger->remove($user);
        $objectmanger->flush();
        return $this->redirectToRoute("utilisateur");

    }
        
}
