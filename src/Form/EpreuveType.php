<?php

namespace App\Form;

use App\Entity\Epreuves;
use App\Entity\Semestre;
use App\Entity\TypeEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EpreuveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file',FileType::class)
            ->add('annee')
            ->add('type',EntityType::class,[
                'class'=>TypeEvaluation::class,
                'choice_label'=>'libelle'
            ])
            ->add('matiere')
            ->add('semestre',EntityType::class,[
                'class'=>Semestre::class,
                'choice_label'=>'libelle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Epreuves::class,
        ]);
    }
}
