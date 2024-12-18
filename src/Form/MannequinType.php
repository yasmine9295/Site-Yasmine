<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Defile;
use App\Entity\Mannequins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 

class MannequinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Nationalite')
            ->add('biographieM', TextareaType::class, [
                'attr' => ['placeholder' => 'Courte biographie...', 'rows' => 10]
                ]) 
            ->add('defiles', EntityType::class, [
                'class' => Defile::class,      
                'choice_label' => 'nomD',     
                'multiple' => true,          
                'expanded' => false,        
      ])   
      
      ;
    }

   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mannequins::class,
        ]);
    }
}
