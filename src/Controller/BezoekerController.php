<?php

namespace App\Controller;

use App\Entity\Training;
use App\Entity\User;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormTypeInterface;

class BezoekerController extends AbstractController
    {
        /**
         * @Route("/", name="homepagina")
         */
        public function homepageaction()
        {
            $trainingen = $this->getDoctrine()
                ->getRepository(Training::class)
                ->findAll();

            return $this->render('bezoeker/homepage.html.twig',[
            'title' => 'Agenda',
                'trainingen'=> $trainingen
        ]);
        }
        /**
         * @Route("/trainingsaanbod", name="trainingsaanbodpagina")
         */
        public function trainingsaanbodaction()
        {
            $trainingen = $this->getDoctrine()
                ->getRepository(Training::class)
                ->findAll();

            return $this->render('bezoeker/trainingsaanbod.html.twig', [
                'title' => 'Agenda',
                'trainingen'=> $trainingen
            ]);
        }
        /**
         * @Route("/gedragsregels", name="gedragsregelspagina")
         */
        public function gedragsregelsaction()
        {
            $training = $this->getDoctrine()
                ->getRepository(Training::class)
                ->findAll();

            return $this->render('bezoeker/gedragsregels.html.twig', [
                'title' => 'Agenda',
            ]);
        }

        /**
        * @Route("/register", name="app_register")
        */
        public function registerNewMemberAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $newMember = new User();
        $form= $this->createForm(UserType::class, $newMember);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $newMember=$form->getData();
            $newMember->setPassword($passwordEncoder->encodePassword($newMember,$form->get('Wachtwoord')->getData()));
            $newMember->setRoles(['ROLE_USER']);

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($newMember);
            $entityManager->flush();
            return $this->redirectToRoute('homepagina');
        }
        return $this->render('security/register.html.twig', ['form'=>$form->createView(),]);
    }
    }