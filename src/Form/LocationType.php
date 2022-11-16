<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('titre')
            ->add('image')
            ->add('description')
            ->add('surface')
            ->add('type')
            ->add('nbchambre')
            ->add('nbetage')
            ->add('prix')
            ->add('adresse')
            ->add('accessibilite')
            ->add('statut')
            ->add('alaune')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
