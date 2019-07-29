<?php

namespace App\Form;

use App\Entity\Affiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AfficheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('detail')
            // ->add('CreateAt')
            // ->add('updateAt')
            ->add('fichiers',FileType::class,[
                'mapped'=>false,
                'label'=>'charger des fichiers',
                'multiple'=>true,
                'attr'=>[
                'class'=>'form-control'
                ]
            ])
            ->add('departement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affiche::class,
        ]);
    }
}
