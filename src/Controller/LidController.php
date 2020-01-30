<?php


namespace App\Controller;

use App\Entity\Inschrijving;
use App\Entity\Les;
use App\Repository\LesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Training;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Flex\Response;

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
    /**
     * @Route("/lessen", name="lessenpagina")
     */
        public function lessenaction()
    {
        $lessen = $this->getDoctrine()
            ->getRepository(Les::class)
            ->findAll();

        return $this->render('lid/lessen.html.twig',[
            'title' => 'Agenda',
            'lessen'=> $lessen
        ]);
    }

    /**
     * @Route("/inschrijfhome/{item}", name="inschrijfpagina")
     */
    public function inschrijfaction(EntityManagerInterface $em, $item)
    {
        $User = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Les::class);
        $Les = $repository->find($item);

        $inschrijving = new inschrijving();
        $inschrijving->setLes($Les);
        $inschrijving->setLid($User);

        $inschrijving->setPayment(false);

        $em->persist($inschrijving);
        $em->flush();

        return $this->redirectToRoute('lessenpagina');
    }

}