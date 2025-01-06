<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Defile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MarquesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomM', TextType::class, [
                'label' => 'Nom de la marque',
                'attr' => ['placeholder' => 'Entrez le nom de la marque '],
                'required' => true,
            ])
            ->add('CreateurM', TextType::class, [
                'label' => 'Créateur de la marque',
                'attr' => ['placeholder' => 'créateur de la marque'],
                'required' => true,
            ])
            ->add('HistoireM', TextareaType::class, [
                'label' => 'Histoire de la marque',
                'attr' => ['placeholder' => 'Ajoutez une brève histoire', 'rows' => 5],
                'required' => false,
            ])
            ->add('RepresentantM', TextType::class, [
                'label' => 'Représentant',
                'attr' => ['placeholder' => 'Représentant de la marque'],
                'required' => false,
            ])
            ->add('image', UrlType::class, [
                'label' => 'Lien vers l\'image de la marque',
                'attr' => ['placeholder' => 'Entrez l\'URL de l\'image...'],
                'required' => false,
                'constraints' => [
                    new Url(['message' => 'Veuillez entrer une URL valide.']),
                ],
            ])
            ->add('defiles', EntityType::class, [
                'class' => Defile::class,
                'multiple' => true,
                'expanded' => false,  // false pour une liste déroulante, true pour des cases à cocher
                'choice_label' => 'NomD',  // Assurez-vous que cette propriété existe dans l'entité Defile
                'label' => 'Défilés associés',
                'placeholder' => 'Choisir un défilé',
                'attr' => ['class' => 'form-control'],
            ]);
        
        ;
    
            }
        }