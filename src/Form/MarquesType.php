<?php

namespace App\Form;

use App\Entity\Marque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MarquesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomM', TextType::class, [
                'label' => 'Nom du Mannequin',
                'attr' => ['placeholder' => 'Entrez le nom du mannequin'],
                'required' => true,
            ])
            ->add('CreateurM', TextType::class, [
                'label' => 'Créateur',
                'attr' => ['placeholder' => 'Nom du créateur du mannequin'],
                'required' => true,
            ])
            ->add('HistoireM', TextareaType::class, [
                'label' => 'Histoire du Mannequin',
                'attr' => ['placeholder' => 'Ajoutez une brève histoire', 'rows' => 5],
                'required' => false,
            ])
            ->add('RepresentantM', TextType::class, [
                'label' => 'Représentant',
                'attr' => ['placeholder' => 'Nom du représentant du mannequin'],
                'required' => false,
            ])
            ->add('image', UrlType::class, [
                'label' => 'Lien vers l\'image de la marque',
                'attr' => ['placeholder' => 'Entrez l\'URL de l\'image...'],
                'required' => false  
            ])
        ;
    
            }
        }