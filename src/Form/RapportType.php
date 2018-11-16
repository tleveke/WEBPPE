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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class, array(
                'widget' => 'choice',
                'label' => 'Saisir la date',
            ))
            ->add('motif',  ChoiceType::class, array(
                'choices'  => array(
                    'visite annuelle' => 'visite annuelle',
                    'nouveauté' => 'nouveauté',
                    'demande du médecin' => 'demande du médecin',
                    'installation nouvelle' => 'installation nouvelle',
                    'installation récente' => 'installation récente',
                    'recommandation de confrère' => 'recommandation de confrère',
                    'prise de contact' => 'prise de contact',
                    'autre' => 'autre',
                ),
            ))
            ->add('bilan', TextareaType::class, array(
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('idvisiteur', EntityType::class, array(
                'class' => Visiteur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'label' => 'Nom du Visiteur',
            ))
            ->add('idmedecin', EntityType::class, array(
                'class' => Medecin::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'label' => 'Nom du medecin',
            ))
            ->add('offrirs', CollectionType::class, [
                'entry_type' => OffrirType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                // this allows the creation of new forms and the prototype too
                'allow_add' => true,
                // self explanatory, this one allows the form to be removed
                'allow_delete' => true,
                'label' => 'La liste des échantillon'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
