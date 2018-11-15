<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\Visiteur;
use App\Entity\Rapport;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class, array(
                'widget' => 'choice',
            ))
            ->add('motif',  ChoiceType::class, array(
                'choices'  => array(
                    'visite annuelle' => 'visite annuelle',
                    'nouveauté' => 'nouveauté',
                    'demande du médecin' => 'demande du médecin',
                    'autre' => 'autre',
                ),
            ))
            ->add('bilan', TextareaType::class, array(
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('idvisiteur', EntityType::class, array(
                'class' => Visiteur::class,
                'choice_label' => 'nom',
                'label' => 'Nom du Visiteur',
            ))
            ->add('idmedecin', EntityType::class, array(
                'class' => Medecin::class,
                'choice_label' => 'nom',
                'label' => 'Nom du medecin',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
