<?php

namespace App\Form;

use App\Entity\Search;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grandeur',ChoiceType::class, array(
                'choices'  => array(
                    'Après le' => '>=',
                    'Avant le' => '<=',
                ),
                'label' => 'Rechercher',
            ))
            ->add('date', DateType::class, array(
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'label' => 'Choisir la date'
            ))
            ->add('choixTri',ChoiceType::class, array(
                'choices'  => array(
                    'Du plus recent' => 'desc',
                    'Au plus ancien' => 'asc',
                ),
                'label' => 'Choisir le tri',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
        ]);
    }
}
