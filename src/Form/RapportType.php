<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\Visiteur;
use App\Entity\Rapport;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('motif')
            ->add('bilan')
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
            ->add('idmedicament', EntityType::class, array(
                'class' => Medicament::class,
                'choice_label' => 'nomcommercial',
                'label' => 'Nom du medicament',
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
