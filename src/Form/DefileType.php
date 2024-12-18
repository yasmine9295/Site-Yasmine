<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Defile;
use App\Entity\Marque; 
use App\Entity\Mannequins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomD', TextType::class, [
                'label' => "Nom du défilé",
                'attr' => [
                    'placeholder' => "Saisir le nom du défilé"
                ]
            ])
            ->add('mannequin', EntityType::class, [
                'class' => Mannequins::class, 
                'choice_label' => 'nom', 
                'label' => 'Choisir un mannequin',
                'multiple' => true,
                'by_reference' => false, 
            ])
            ->add('Date', DateType::class, [
                'widget' => 'single_text', 
                'label' => 'Date du défilé',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class, 
                'choice_label' => 'NomM', 
                'label' => 'Choisir une marque'
            ])
            ->add('blogs', EntityType::class, [
                'class' => Blog::class, 
                'choice_label' => 'Blogs', 
                'label' => 'Saisir les blogs du défilé',
                'multiple' => true, 
                'by_reference' => false, 
            ])
            ->add('description', TextType::class, [
                'label' => 'Description du défilé',
                'attr' => [
                    'placeholder' => 'Saisir une description'
                ]
            ])
            ->add('theme', ChoiceType::class, [
                'choices' => [
                    'Solo' => 0,
                    'Groupe' => 1
                ],
                'label' => 'Choisir un thème'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Defile::class, 
        ]);
    }
}
