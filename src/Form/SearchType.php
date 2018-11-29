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
                    'Plus grand que' => '>',
                    'Moins grand que' => '<',
                ),
                'label' => 'Choisir la grandeur',
            ))
            ->add('date', DateType::class, array(
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'label' => 'Choisir la date',
                'placeholder' => array(
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                )
            ))
            ->add('choixTri',ChoiceType::class, array(
                'choices'  => array(
                    'Au plus ancien' => 'asc',
                    'Au plus recent' => 'desc',
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
