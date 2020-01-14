<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Training;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LidController extends AbstractController
{
    /**
     * @Route("/lidhome", name="lidpagina")
     */
    public function lidhomeaction()
    {
        $trainingen = $this->getDoctrine()
            ->getRepository(Training::class)
            ->findAll();

        return $this->render('lid/lidhome.html.twig',[
            'title' => 'Agenda',
            'trainingen'=> $trainingen
        ]);
    }
}