<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dependencyMinimum', null, [
                'constraints' => [
                ],
                'label' => 'deduction.dependencyMinimum',
            ])
            ->add('dependencyMaximum', null, [
                'constraints' => [
                ],
                'label' => 'deduction.dependencyMaximum',
            ])
            ->add('housingPercentage', null, [
                'constraints' => [
                ],
                'label' => 'deduction.housingPercentage',
            ])
            ->add('housingMaximum', null, [
                'constraints' => [
                ],
                'label' => 'deduction.housingMaximum',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
