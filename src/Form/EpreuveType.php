<?php

namespace App\Form;

use App\Entity\Epreuves;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EpreuveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file',FileType::class)
            ->add('annee')
            ->add('type',ChoiceType::class,[
                'choices' => [
                    'Partiel' => '0',
                    'Examen'  => '1'
                ]
            ])
            ->add('matiere')
            ->add('semestre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Epreuves::class,
        ]);
    }
}
