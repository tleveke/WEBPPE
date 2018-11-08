<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\Visiteur;
use App\Entity\Rapport;

<<<<<<< HEAD
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

=======
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
>>>>>>> bf8f4c8803da7be21abbcb006391f1a473432627
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
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
            ->add('idmedicament', EntityType::class, array(
                'class' => Medicament::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('medicament')
                        ->orderBy('medicament.nomcommercial', 'ASC');
                },
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
