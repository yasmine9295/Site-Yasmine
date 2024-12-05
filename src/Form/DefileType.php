<?php

namespace App\Form;


use App\Form\DefileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DefileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomD', TextType::class,[
                'label'=>"Nom du defile",
                'attr'=>[
                    "placeholder"=>"Saisir le nom du defile"
                ]
            ])
            ->add('mannequin', TextareaType::class)
            ->add('Date',DateType::class)
            ->add('marque', TextType::class)
            ->add('description', TextType::class)
            ->add('Theme',ChoiceType::class, [
                "choices"=>[
                    "solo"=>0,
                    "groupe"=>1
                ]
            ])
        ;
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Defile::class,
    //     ]);
    // }
}
