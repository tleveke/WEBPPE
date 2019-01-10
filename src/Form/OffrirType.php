<?php

namespace App\Form;

use App\Entity\Offrir;
use App\Entity\Rapport;
use App\Entity\Medicament;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class OffrirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            //->add('medicament', EntityType::class, array(
            //    'class' => Medicament::class,
            //    'query_builder' => function (EntityRepository $er) {
            //        return $er->createQueryBuilder('u')
            //            ->orderBy('u.nomcommercial', 'ASC');
            //    },
            //    'choice_label' => 'nomcommercial',
            //    'label' => 'Nom du medicament',
            //
            //))
            ->add("medicament", EntityType::class, [
                    'class' => Medicament::class,
                    'choice_label' => 'nomcommercial',
                    'attr' => [ 
                        'placeholder'   => 'Entrer le nom du médicament',
                        'class' => 'autocomplete'
                    ],
                    'label' => 'Nom du medicament',
                ])
            ->add('quantite',IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Offrir::class,
        ));
    }
}
