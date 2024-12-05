<?php

namespace App\Form;

use App\Entity\Defile; // Assurez-vous d'avoir cette importation
use App\Entity\Mannequin; // Importation de l'entité Mannequin si nécessaire
use App\Entity\Marque; // Importation de l'entité Marque si nécessaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;

class DefileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomD', TextType::class, [
                'label' => "Nom du defile",
                'attr' => [
                    "placeholder" => "Saisir le nom du defile"
                ]
            ])
            ->add('mannequin', EntityType::class, [
                'class' => Mannequin::class, 
                'choice_label' => 'nom', 
                'label' => 'Choisir un mannequin'
            ])
            ->add('Date', DateType::class, [
                'widget' => 'single_text', 
                'label' => 'Date du défilé',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class, 
                'choice_label' => 'nom', 
                'label' => 'Choisir une marque'
            ])
            ->add('blogs', TextareaType::class, [
                'label' => 'Blogs',
                'attr' => [
                    'placeholder' => 'Saisir les blogs du défilé'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description du défilé',
                'attr' => [
                    'placeholder' => 'Saisir une description'
                ]
            ])
            ->add('Theme', ChoiceType::class, [
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
