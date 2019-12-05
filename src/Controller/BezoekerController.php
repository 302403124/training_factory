<?php

namespace App\Controller;

use App\Entity\Training;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

    class BezoekerController extends AbstractController
    {
        /**
         * @Route("/homepage", name="homepagina")
         */
        public function homepageaction()
        {
            $trainingen = $this->getDoctrine()
                ->getRepository(Training::class)
                ->findAll();

            return $this->render('homepage.html.twig',[
            'title' => 'Agenda',
                'trainingen'=> $trainingen
        ]);
        }
        /**
         * @Route("/contact", name="contactpagina")
         */
        public function contactaction()
        {
            $training = $this->getDoctrine()
                ->getRepository(Training::class)
                ->findAll();

            return $this->render('contact.html.twig', [
                'title' => 'Agenda',
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

            return $this->render('trainingsaanbod.html.twig', [
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

            return $this->render('gedragsregels.html.twig', [
                'title' => 'Agenda',
            ]);
        }
    }