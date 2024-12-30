<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomArticle', TextType::class, [
                'label' => 'Nom de l\'article',
            ])
            ->add('Contenu', TextareaType::class, [
                'label' => 'Contenu',
            ])
            ->add('Date', DateTimeType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false, // This is not bound to the entity field
                'attr' => ['accept' => 'image/*']
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}

