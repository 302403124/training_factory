<?php


namespace App\Form\Type;


use App\Entity\Training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

class LesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Tijd', TimeType::class)
            ->add('locatie', TextType::class)
            ->add('datum', DateType::class)
            ->add('max_personen', IntegerType::class)
            ->add('training', EntityType::class,[
                'class' =>Training::class,
                'choice_label' => 'naam'
            ])
            ->add('save', SubmitType::class
            );
    }
}