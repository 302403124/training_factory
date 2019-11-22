<?php

namespace App\Controller;

use App\Entity\Training;
use Symfony\Component\Routing\Annotatio\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @\Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/training", name="create_product")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $training = new training();
        $training->setNaam('Kickboks');
        $training->setDescription('conditie training en oefenen met kicks');
        $training->setDuration(45);
        $training->setCosts(25);


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($training);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new training with id '.$training->getId());
    }
}