<?php

namespace App\Form;

use App\Entity\Etablissement;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('nature')
            ->add('secteur')
            ->add('longitude')
            ->add('latitude')
            ->add('adresse')
            ->add('departement')
            ->add('commune')
            ->add('region')
            ->add('academie')
            ->add('date_ouverture')
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
