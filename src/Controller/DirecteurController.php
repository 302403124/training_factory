<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\TrainingType;
use App\Entity\Training;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DirecteurController extends AbstractController
{
    /**
     * @Route("/form", name="form")
    */
    public function contactaction(Request $request)
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

        return $this->render('bezoeker/form.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/admin", name="adminpagina")
     */
    public function adminaction()
    {
        $trainingen = $this->getDoctrine()
            ->getRepository(Training::class)
            ->findAll();

        return $this->render('Admin/adminhome.html.twig',[
            'title' => 'Agenda',
            'trainingen'=> $trainingen
        ]);
    }
    /**
     * @Route("/admintraining", name="admintraining")
     */
    public function admintrainingaction()
    {
        $trainingen = $this->getDoctrine()
            ->getRepository(Training::class)
            ->findAll();

        return $this->render('Admin/admintraining.twig',[
            'title' => 'Agenda',
            'trainingen'=> $trainingen
        ]);
    }
    /**
     * @Route("/agenda", name="agendapagina")
     */
    public function agendaaction()
    {
        $trainingen = $this->getDoctrine()
            ->getRepository(Training::class)
            ->findAll();

        return $this->render('Admin/agenda.html.twig',[
            'title' => 'Agenda',
            'trainingen'=> $trainingen
        ]);
    }
    /**
     * @Route("/ledenlijst", name="ledenpagina")
     */
    public function ledenlijstaction()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('Admin/ledenlijst.html.twig',[
            'title' => 'Agenda',
            'users'=> $users
        ]);
    }
    /**
     * @Route("user/delete/{item}", name="DeleteUser")
     */
    public function userDeleteAction($item)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find($item);
            $entityManager->remove($user);
            $entityManager->flush();

            return $this->redirectToRoute('ledenpagina');
    }
    /**
     * @Route("user/edit/{item}", name="EditUser")
     */
    public function userEditaction(Request $request, $item, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $lid = $repository->find($item);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($item);

        $em->persist($user);]
        $em->flush();

        return $this->render('', [
            'title' => '|Lid gegevens',
            'lid' => $lid,
            'user' => $user,
        ]);
    }
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $user = $entityManager->getRepository(User::class)->find($item);
//        $savePassword = $user->getPassword();
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid())
//        {
//            $user = $form->getData();
//            $password=$form->get('Wachtwoord')->getData();
//            if (!$password)
//            {
//                $user->setPassword($savePassword);
//            }
//            else{
//                $user->setPassword($passwordEncoder->encodePassword($user, $password));
//            }
//
//            $entityManager->persist($user);
//            $entityManager->flush();
//            return $this->redirectToRoute('ledenpagina');
//        }
//        return $this->render('Admin/adminhome.html.twig');
//    }
}