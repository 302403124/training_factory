<?php


namespace App\Controller;


use App\Entity\Les;
use App\Entity\Training;
use App\Form\Type\LesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InstructeurController extends AbstractController
{
    /**
     * @Route("lestoevoegen", name="lestoevoegen")
     */
    public function lestoevoegenaction(Request $request)
    {
        $User = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $les = new Les();

        $form = $this->createForm(LesType::class, $les);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $les = $form->getData();
            $les->setInstructeur($User);
            $em->persist($les);
            $em->flush();

            return $this->redirectToRoute('homepagina');
        }
        return $this->render('Instructeur/lestoevoegen.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}