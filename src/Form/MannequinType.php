<?php

namespace App\Form;
use App\Entity\Defile;
use App\Entity\Mannequins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MannequinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
            ])
            ->add('Prenom', TextType::class, [
                // 'constraints' => [
                //     new NotBlank(['message' => 'Le prénom est obligatoire.']),
                //     new Length(['min' => 2, 'minMessage' => 'Le prénom doit comporter au moins {{ limit }} caractères.']),
                // ],
            ])
            ->add('Nationalite', TextType::class, [
                // 'constraints' => [
                //     new NotBlank(['message' => 'La nationalité est obligatoire.']),
                // ],
            ])
            ->add('biographieM', TextareaType::class, [
                'attr' => ['placeholder' => 'Courte biographie...', 'rows' => 10],
                // 'constraints' => [
                //     new NotBlank(['message' => 'La biographie est obligatoire.']),
                //     new Length(['min' => 20, 'minMessage' => 'La biographie doit comporter au moins {{ limit }} caractères.']),
                // ],
            ]) 
            ->add('defiles', EntityType::class, [
                'class' => Defile::class,      
                'choice_label' => 'nomD',     
                'multiple' => true,          
                'expanded' => false,        
                // 'constraints' => [
                //     new NotBlank(['message' => 'Veuillez sélectionner au moins un défilé.']),
                // ],
            ])    
            ->add('imageMannequins', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false, 
                'attr' => ['accept' => 'image/*']
                
            ]);


        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mannequins::class,
        ]);
    }
}
