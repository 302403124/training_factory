<?php

namespace App\Controller;

use App\Form\Type\TrainingType;
use App\Entity\Training;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DirecteurController extends AbstractController
{
    /**
     * @Route("/form", name="form")
*/
    public function new(Request $request)
    {
        $training = new Training();

        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $training = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($training);
             $entityManager->flush();

            return $this->redirectToRoute('form');
        }

        return $this->render('form.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}